(function () {
    const dados = window.CURRICULOS;
    const popup = document.getElementById('popup-palestrante');
    if (!dados || !popup) return;

    const nome = popup.querySelector('.js-cv-nome');
    const tema = popup.querySelector('.js-cv-tema');
    const foto = popup.querySelector('.js-cv-foto');
    const itens = popup.querySelector('.js-cv-itens');

    function abrir(bt) {
        const p = dados[bt.dataset.quem];
        if (!p) return;

        nome.textContent = p.nome;
        tema.textContent = bt.dataset.tema || '';
        foto.hidden = p.foto === '';
        foto.src = p.foto;
        foto.alt = 'Retrato de ' + p.nome;

        itens.textContent = '';
        p.cv.forEach((linha) => {
            const li = document.createElement('li');
            li.textContent = linha;
            itens.appendChild(li);
        });

        popup.classList.add('aberto');
        document.body.style.overflow = 'hidden';
        popup.querySelector('.js-fechar-cv').focus();
    }

    function fechar() {
        popup.classList.remove('aberto');
        document.body.style.overflow = '';
    }

    document.querySelectorAll('.js-abrir-cv').forEach((bt) => {
        bt.addEventListener('click', () => abrir(bt));
    });

    popup.querySelector('.js-fechar-cv').addEventListener('click', fechar);

    popup.addEventListener('click', (e) => {
        if (e.target === popup) fechar();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && popup.classList.contains('aberto')) fechar();
    });
})();
