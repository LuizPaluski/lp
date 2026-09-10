(function () {
    const dados = window.SIMPOSIO;
    const popup = document.getElementById('popup-inscricao');
    if (!dados || !popup) return;

    const etapa1 = popup.querySelector('[data-etapa="1"]');
    const etapa2 = popup.querySelector('[data-etapa="2"]');
    const nome = popup.querySelector('#nome');
    const telefone = popup.querySelector('#telefone');
    const cupom = popup.querySelector('#cupom');
    const avisoCupom = popup.querySelector('.js-aviso-cupom');
    const btContinuar = popup.querySelector('.js-continuar');
    const btEnviar = popup.querySelector('.js-enviar');

    let modalidade = null;
    let enviando = false;

    function temCupom() {
        return cupom !== null && cupom.value.trim() !== '';
    }

    // sem a escolha de vínculo no popup, quem informa o cupom é aluno ou ex-aluno da pós
    function categoria() {
        return temCupom() ? dados.comCupom : 'geral';
    }

    function workshopsMarcados() {
        return Array.from(popup.querySelectorAll('input[name="workshop"]:checked')).map((c) => c.value);
    }

    function totalCentavos() {
        const base = dados.modalidades[modalidade].preco;
        return workshopsMarcados().reduce((soma, id) => soma + dados.workshops[id].valor, base);
    }

    function brl(centavos) {
        return (centavos / 100).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }

    function urlCheckout() {
        const porCondicao = dados.modalidades[modalidade].checkoutIds;
        const ids = [porCondicao[categoria()] || porCondicao.geral];
        workshopsMarcados().forEach((id) => ids.push(dados.workshops[id].checkoutId));
        return dados.checkoutBase + '/' + ids.join('-') + '?' + dados.utm;
    }

    function titulosWorkshops() {
        return workshopsMarcados().map((id) => dados.workshops[id].titulo);
    }

    function atualizarTotal() {
        popup.querySelector('.js-total').textContent = brl(totalCentavos());
    }

    function dadosPreenchidos() {
        return nome.value.trim().length >= 3 && telefone.value.replace(/\D/g, '').length >= 10;
    }

    function mascaraTelefone(valor) {
        const d = valor.replace(/\D/g, '').slice(0, 11);
        if (d.length <= 2) return d.length ? '(' + d : '';
        if (d.length <= 6) return '(' + d.slice(0, 2) + ') ' + d.slice(2);
        if (d.length <= 10) return '(' + d.slice(0, 2) + ') ' + d.slice(2, 6) + '-' + d.slice(6);
        return '(' + d.slice(0, 2) + ') ' + d.slice(2, 7) + '-' + d.slice(7);
    }

    function mostrarEtapa(numero) {
        etapa1.hidden = numero !== 1;
        etapa2.hidden = numero !== 2;
    }

    function abrir(id) {
        modalidade = id;
        popup.querySelector('.js-modalidade').textContent = dados.modalidades[id].titulo;
        mostrarEtapa(1);
        atualizarTotal();
        popup.classList.add('aberto');
        document.body.style.overflow = 'hidden';
    }

    function fechar() {
        popup.classList.remove('aberto');
        document.body.style.overflow = '';
    }

    // a lista de cupons fica no servidor, então a conferência é feita lá
    function conferirCupom() {
        return fetch(dados.endpointCupom, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ codigo: cupom.value })
        }).then((r) => r.json());
    }

    function irParaEtapa2() {
        popup.querySelector('.js-resumo-workshops').textContent = titulosWorkshops().join(', ') || 'nenhum';
        popup.querySelector('.js-resumo-total').textContent = brl(totalCentavos());
        const linhaCupom = popup.querySelector('.js-resumo-linha-cupom');
        if (linhaCupom) {
            linhaCupom.hidden = !temCupom();
            popup.querySelector('.js-resumo-cupom').textContent = cupom.value.trim();
        }
        mostrarEtapa(2);
        nome.focus();
    }

    document.querySelectorAll('.js-abrir-popup').forEach((bt) => {
        bt.addEventListener('click', () => abrir(bt.dataset.modalidade));
    });

    popup.querySelector('.js-fechar').addEventListener('click', fechar);

    popup.addEventListener('click', (e) => {
        if (e.target === popup) fechar();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && popup.classList.contains('aberto')) fechar();
    });

    popup.querySelectorAll('input[name="workshop"]').forEach((campo) => {
        campo.addEventListener('change', atualizarTotal);
    });

    if (cupom) {
        cupom.addEventListener('input', () => {
            avisoCupom.textContent = '';
        });
    }

    btContinuar.addEventListener('click', () => {
        // cupom em branco é o caminho normal: só quem tem vínculo com a pós preenche
        if (!temCupom()) {
            irParaEtapa2();
            return;
        }

        btContinuar.disabled = true;
        conferirCupom()
            .then((resposta) => {
                if (resposta.valido) {
                    irParaEtapa2();
                    return;
                }
                avisoCupom.textContent = 'Cupom não encontrado. Confira o código com a secretaria.';
                cupom.focus();
            })
            .catch(() => {
                // sem resposta do servidor o cupom segue para a conferência no checkout
                irParaEtapa2();
            })
            .finally(() => {
                btContinuar.disabled = false;
            });
    });

    popup.querySelector('.js-voltar').addEventListener('click', () => mostrarEtapa(1));

    telefone.addEventListener('input', () => {
        telefone.value = mascaraTelefone(telefone.value);
    });

    [nome, telefone].forEach((campo) => {
        campo.addEventListener('input', () => {
            btEnviar.disabled = !dadosPreenchidos();
        });
    });

    btEnviar.addEventListener('click', () => {
        if (enviando || !dadosPreenchidos()) return;
        enviando = true;
        btEnviar.textContent = 'Enviando...';

        const lead = JSON.stringify({
            nome: nome.value.trim(),
            telefone: telefone.value.trim(),
            categoria: categoria(),
            cupom: temCupom() ? cupom.value.trim() : '',
            modalidade: modalidade,
            workshops: workshopsMarcados(),
            origem: window.location.href
        });

        // sendBeacon porque a página sai do ar em seguida: um fetch comum seria abortado.
        navigator.sendBeacon(dados.endpoint, new Blob([lead], { type: 'application/json' }));

        window.location.href = urlCheckout();
    });
})();
