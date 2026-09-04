(function () {
    const dados = window.SIMPOSIO;
    const popup = document.getElementById('popup-inscricao');
    if (!dados || !popup) return;

    const etapa1 = popup.querySelector('[data-etapa="1"]');
    const etapa2 = popup.querySelector('[data-etapa="2"]');
    const nome = popup.querySelector('#nome');
    const telefone = popup.querySelector('#telefone');
    const btEnviar = popup.querySelector('.js-enviar');

    let modalidade = null;
    let enviando = false;

    function categoria() {
        return popup.querySelector('input[name="categoria"]:checked').value;
    }

    function workshopsMarcados() {
        return Array.from(popup.querySelectorAll('input[name="workshop"]:checked')).map((c) => c.value);
    }

    function comVinculoUfape() {
        return dados.comVinculo.includes(categoria());
    }

    function totalCentavos() {
        const base = dados.modalidades[modalidade].precos[categoria()];
        return workshopsMarcados().reduce((soma, id) => soma + dados.workshops[id].valor, base);
    }

    function brl(centavos) {
        return (centavos / 100).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }

    function urlCheckout() {
        const ids = [dados.modalidades[modalidade].checkoutId];
        workshopsMarcados().forEach((id) => ids.push(dados.workshops[id].checkoutId));
        return dados.checkoutBase + '/' + ids.join('-') + '?' + dados.utm;
    }

    function urlWhatsapp() {
        const linhas = [
            'Olá! Quero me inscrever no Simpósio Plantonista Veterinário UFAPE (Cardiologia).',
            '',
            'Nome: ' + nome.value.trim(),
            'Telefone: ' + telefone.value.trim(),
            'Categoria: ' + dados.categorias[categoria()],
            'Modalidade: ' + dados.modalidades[modalidade].titulo,
            'Workshops: ' + (titulosWorkshops().join(', ') || 'nenhum'),
            'Lote: ' + dados.lote + 'º',
            'Total estimado: ' + brl(totalCentavos())
        ];
        return 'https://wa.me/' + dados.whatsapp + '?text=' + encodeURIComponent(linhas.join('\n'));
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

    popup.querySelectorAll('input[name="categoria"], input[name="workshop"]').forEach((campo) => {
        campo.addEventListener('change', atualizarTotal);
    });

    popup.querySelector('.js-continuar').addEventListener('click', () => {
        popup.querySelector('.js-resumo-categoria').textContent = dados.categorias[categoria()];
        popup.querySelector('.js-resumo-workshops').textContent = titulosWorkshops().join(', ') || 'nenhum';
        popup.querySelector('.js-resumo-total').textContent = brl(totalCentavos());
        btEnviar.textContent = comVinculoUfape() ? 'Falar no WhatsApp' : 'Ir para o checkout';
        mostrarEtapa(2);
        nome.focus();
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

        const paraWhatsapp = comVinculoUfape();
        const lead = JSON.stringify({
            nome: nome.value.trim(),
            telefone: telefone.value.trim(),
            categoria: categoria(),
            modalidade: modalidade,
            workshops: workshopsMarcados(),
            destino: paraWhatsapp ? 'whatsapp' : 'checkout',
            origem: window.location.href
        });

        // sendBeacon porque a página sai do ar em seguida: um fetch comum seria abortado.
        navigator.sendBeacon('inscricao.php', new Blob([lead], { type: 'application/json' }));

        if (paraWhatsapp) {
            window.open(urlWhatsapp(), '_blank', 'noopener,noreferrer');
            enviando = false;
            btEnviar.textContent = 'Falar no WhatsApp';
            fechar();
            return;
        }

        window.location.href = urlCheckout();
    });
})();
