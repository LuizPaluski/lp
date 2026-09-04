# Simpósio Plantonista Veterinário UFAPE, Cardiologia 2026

Landing page do simpósio em PHP, com a identidade visual da Faculdade Ufape
(`faculdade.ufape.com.br`). Versão em PHP da LP originalmente feita no Lovable
(`LuizPaluski/ufape-simposio-site`).

## Estrutura

```
index.php                      página inteira
inscricao.php                  recebe o lead do popup e repassa ao webhook
includes/dados.php             preços, lotes, IDs do checkout, funções de cálculo
includes/conteudo.php          programação, palestrantes, workshops, FAQ
includes/header.php            topo institucional e menu
includes/popup-inscricao.php   popup de inscrição em duas etapas
includes/footer.php            rodapé institucional
assets/                        css, js e imagens
```

## Rodando local

```sh
php -S localhost:8000
```

Precisa de PHP 8.1 ou superior com `mbstring` e `curl`.

## Fluxo de inscrição

O popup calcula o total pela modalidade, categoria e workshops escolhidos e leva
o usuário a um de dois destinos:

- **Ex-aluno UFAPE** (pós-graduação ou cursos abertos): WhatsApp da secretaria,
  com a mensagem preenchida, porque o vínculo precisa ser conferido antes.
- **Demais participantes**: carrinho da faculdade, em
  `cart/add/535-662-<ids>`, com UTMs de origem.

Em paralelo, o navegador chama `inscricao.php`, que recalcula os valores no
servidor (nada de preço vindo do cliente) e posta o lead no webhook.

## Onde mexer

- **Preços e lotes**: `includes/dados.php`. Valores em centavos. A virada do
  primeiro para o segundo lote é automática, pela constante `LOTE_1_ATE`.
- **IDs do checkout**: `checkout_id` de cada modalidade e workshop, no mesmo
  arquivo. São os IDs dos cursos no carrinho da faculdade.
- **Textos, programação e palestrantes**: `includes/conteudo.php`.
- **Webhook**: constante `WEBHOOK_INSCRICAO`, em `includes/dados.php`.

## Publicação

Basta subir os arquivos: não há build nem dependência de composer. Confira que
o `assets/img/` foi junto e que o PHP do servidor tem `curl` habilitado, senão o
lead não chega ao webhook (a inscrição em si continua funcionando, porque o
destino é aberto pelo navegador).
