<?php
// Cabeçalho institucional replicado para quando a página roda fora do sistema da
// faculdade. O estilo, os ícones e o script do menu vêm do próprio site; o mini
// carrinho não mostra quantidade porque a sessão do carrinho é do sistema.
$site = 'https://faculdade.ufape.com.br';
$estilo = $site . '/assets/front/intercursos';

$esquema = ($_SERVER['HTTPS'] ?? 'off') === 'off' ? 'http' : 'https';
$url_base = $esquema . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

$menu_site = [
    ['Graduação', "$site/graduacao", [['Medicina Veterinária - SP', "$site/graduacao"]]],
    ['Pós-graduação', "$site/pos-graduacao", []],
    ['Cursos', "$site/cursos", []],
    ['Aprimoramento', "$site/aprimoramentos", []],
    ['Grupo de <span>Estudos</span>', "$site/grupo-de-estudos", []],
    ['Simpósios e <span>Congressos</span>', "$site/simposios-e-congressos", []],
    ['Ufape <span>estágio</span>', "$site/produto/638/regras-para-estagios-no-hospital-veterinario-ufape-sao-paulo", []],
    ['Provas', "$site/provas", []],
    ['Palestras <span>Gratuitas</span>', "$site/palestras", []],
    ['Fale <span>Conosco</span>', "$site/fale-conosco", []],
    ['UFAPE <span>Clínica</span>', 'https://ufape.com.br/', []],
];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="<?= $url_base ?>/">
    <title>Simpósio Plantonista Veterinário UFAPE | Cardiologia 2026</title>
    <meta name="description" content="Simpósio Plantonista Veterinário UFAPE, Edição Cardiologia. 10 e 11 de outubro de 2026, em São Paulo. Presencial e online gravado por 12 meses.">

    <meta name="facebook-domain-verification" content="cm3z08skorh47obagy1t3dyu43roy7" />

    <meta property="og:title" content="Simpósio Plantonista Veterinário UFAPE, Cardiologia">
    <meta property="og:description" content="Do atendimento inicial ao manejo avançado do paciente cardiológico. 10 e 11 de outubro de 2026, híbrido, com certificado UFAPE.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $url_base ?>/">
    <meta property="og:image" content="<?= $url_base ?>/assets/img/hero-vet-portrait.jpg">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="stylesheet" type="text/css" href="<?= $estilo ?>/components/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= $estilo ?>/css/menu.css">
    <link rel="stylesheet" type="text/css" href="<?= $estilo ?>/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= $estilo ?>/css/responsive.css">
    <link href="<?= $estilo ?>/components/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="<?= $estilo ?>/components/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="<?= $estilo ?>/components/fontawesome/css/solid.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="<?= $site ?>/favicon.ico">

    <!-- estilo do simpósio: depois do estilo do site, para poder sobrescrever -->
    <link rel="stylesheet" href="<?= $lp ?>/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css') ?>">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?= $estilo ?>/components/popper/popper.min.js"></script>
    <script src="<?= $estilo ?>/components/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
        var fullpath = '<?= $site ?>/';
    </script>
    <script src="<?= $estilo ?>/js/main.js"></script>
    <script src="<?= $lp ?>/assets/js/mini-carrinho.js" defer></script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TMV2BQJ3');</script>
    <!-- End Google Tag Manager -->
</head>

<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TMV2BQJ3"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="overlay">
    <div class="load"></div>
</div>

<div class="areaMenuResponsivo">
    <div class="overflow">
        <div class="menuResponsivo">
            <div class="btMenuFechar efeito-01"><i class="fa fa-arrow-right"></i></div>
            <ul class="sub-menu">
                <?php foreach ($menu_site as [$rotulo, $url, $filhos]): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $filhos ? 'javascript:;' : $url ?>"><?= $rotulo ?></a>
                        <?php if ($filhos): ?>
                            <ul class="sub-menu">
                                <?php foreach ($filhos as [$f_rotulo, $f_url]): ?>
                                    <li><a class="nav-link" href="<?= $f_url ?>"><?= $f_rotulo ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<div class="header">
    <div class="header-top">
        <div class="container">
            <div class="row-custom">
                <div class="cols l">
                    <a href="<?= $site ?>">
                        <img src="<?= $estilo ?>/img/2025/logo-faculdade-ufape.png" alt="Faculdade Ufape">
                    </a>
                </div>
                <div class="cols m">
                    <form class="form" method="get" action="<?= $site ?>/produto/busca">
                        <input type="text" name="title" placeholder="Digite o nome do curso que está procurando" class="cp search" value="">
                        <button type="submit" class="search-bt"></button>
                    </form>
                </div>
                <div class="cols r lk-dif">
                    <div class="lk"><a href="<?= $site ?>/account/login">Portal <br> do aluno</a></div>
                </div>
                <div class="cols r">
                    <div class="lks-mini-cart" data-carrinho="<?= $site ?>/cart">
                        <div class="lk-dif-r">
                            <div class="lk"><a href="<?= $site ?>/account/login">Portal <br> do aluno</a></div>
                        </div>
                        <div class="dropdown_">
                            <button type="button" class="mini-cart" id="dropdownMiniCart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                0 Item
                            </button>
                            <div class="dropdown-menu c-mini-cart" aria-labelledby="dropdownMiniCart">
                                <div class="items">
                                    <div class="item nenhum">O carrinho está vazio</div>
                                </div>
                                <div class="subtotal">
                                    <div class="lab">subtotal</div>
                                    <div class="val">R$ <span class="mini-val">0,00</span></div>
                                </div>
                                <div class="bts">
                                    <a href="<?= $site ?>/cart" class="icon-checkout">Finalizar compra</a>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:;" class="sh-mn-resp js-btMenu"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-menu">
        <div class="container">
            <div class="menu">
                <ul>
                    <?php foreach ($menu_site as [$rotulo, $url, $filhos]): ?>
                        <li>
                            <a href="<?= $filhos ? 'javascript:;' : $url ?>"><?= $rotulo ?></a>
                            <?php if ($filhos): ?>
                                <ul>
                                    <?php foreach ($filhos as [$f_rotulo, $f_url]): ?>
                                        <li><a class="nav-link" href="<?= $f_url ?>"><?= $f_rotulo ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
