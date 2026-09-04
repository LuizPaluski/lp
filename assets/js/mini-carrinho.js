// O carrinho é do sistema da faculdade e vive na sessão do visitante. Como esta
// página fica no mesmo domínio, dá para ler a página do carrinho e montar aqui o
// mesmo bloco que o site mostra no topo: contagem, itens e subtotal.
(function () {
    const area = document.querySelector('.lks-mini-cart');
    if (!area) return;

    function linhaDoItem(tr) {
        const remover = tr.querySelector('a[href*="cart/remove/"]');
        const titulo = tr.querySelector('strong');
        const preco = tr.querySelector('.min-price > span');
        if (!remover || !titulo) return null;

        return {
            remover: remover.href,
            titulo: titulo.textContent.replace(/\s+/g, ' ').trim(),
            // o primeiro nó de texto é o valor; os seguintes são as condições de pagamento
            preco: preco ? preco.childNodes[0].textContent.trim() : ''
        };
    }

    function montarItens(itens) {
        if (!itens.length) {
            return '<div class="item nenhum">O carrinho está vazio</div>';
        }
        return itens.map((item) => `
            <div class="item">
                <a href="${item.remover}" class="remove"><i class="fas fa-times"></i></a>
                <div class="title">${item.titulo}</div>
                <div class="price">${item.preco}</div>
            </div>`).join('');
    }

    fetch(area.dataset.carrinho, { credentials: 'same-origin' })
        .then((resposta) => resposta.text())
        .then((html) => {
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const vindo = doc.querySelector('.lks-mini-cart .dropdown_');
            const atual = area.querySelector('.dropdown_');
            if (!vindo || !atual) return;

            // a contagem e o subtotal já vêm prontos; os itens saem da tabela do carrinho
            atual.innerHTML = vindo.innerHTML;
            const itens = Array.from(doc.querySelectorAll('tr')).map(linhaDoItem).filter(Boolean);
            atual.querySelector('.items').innerHTML = montarItens(itens);
        })
        .catch(() => {
            // sem resposta do site, fica o carrinho vazio que já está na tela
        });
})();
