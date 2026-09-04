<?php
if ($this->input->get('utm_source')) {
    //GRAVA AS UTMS QUE FOI INSERIDO NO CARRINHO, PARA ENVIAR PARA WEBHOOK DA GROWTH
    $this->session->set_userdata('utmsCampanha', array(
        'utm_source'    => $this->input->get('utm_source'),
        'utm_medium'    => $this->input->get('utm_medium'),
        'utm_campaign'  => $this->input->get('utm_campaign'),
        'utm_term'      => $this->input->get('utm_term'),
        'utm_content'   => $this->input->get('utm_content'),
        'utm_id'        => $this->input->get('utm_id'),
        'gclid'         => $this->input->get('gclid'),
        'fbclid'        => $this->input->get('fbclid'),
        'referral'      => $this->input->get('referral')
    ));
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->router->method; if ($this->router->method === 'search'): ?>
    <meta name="robots" content="noindex,follow">
    <?php else : ?>
    <link rel="canonical" href="<?= current_url(); ?>">
    <?php endif; ?>
    <title><?php echo strip_tags($page_title); ?></title>
    <?php echo (!empty($page_descricao) ? '<meta name="description" content="' . strip_tags($page_descricao) . '">' : ''); ?>

    <meta name="facebook-domain-verification" content="cm3z08skorh47obagy1t3dyu43roy7" />

    <meta property="og:title" content="Simpósio Plantonista Veterinário UFAPE, Cardiologia">
    <meta property="og:description" content="Do atendimento inicial ao manejo avançado do paciente cardiológico. 10 e 11 de outubro de 2026, híbrido, com certificado UFAPE.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= current_url(); ?>">
    <meta property="og:image" content="<?= $lp; ?>/assets/img/hero-vet-portrait.jpg">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/front/intercursos/components/bootstrap/4.4.1/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/front/intercursos/components/slick/slick.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/front/intercursos/css/menu.css?v=' . time() . ''); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/front/intercursos/css/style.css?v=' . time() . ''); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/front/intercursos/css/responsive.css?v=' . time() . ''); ?>">
    <link rel="icon" type="image/x-icon" href="<?php echo site_url('favicon.ico?v=3'); ?>">

    <!-- fonts fontawesome -->
    <link href="<?php echo site_url('assets/front/intercursos/components/fontawesome/css/fontawesome.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/front/intercursos/components/fontawesome/css/brands.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/front/intercursos/components/fontawesome/css/solid.min.css'); ?>" rel="stylesheet">

    <!-- estilo do simpósio: entra depois do estilo do site para poder sobrescrever -->
    <link rel="stylesheet" type="text/css" href="<?= $lp; ?>/assets/css/style.css?v=<?= filemtime(__DIR__ . '/../assets/css/style.css'); ?>">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="<?php echo site_url('assets/front/intercursos/components/jquery-mask/dist/jquery.mask.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/front/intercursos/components/popper/popper.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/front/intercursos/components/bootstrap/4.4.1/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/front/intercursos/components/slick/slick.min.js'); ?>"></script>
    <script>
        var fullpath = '<?php echo base_url(); ?>';
    </script>
    <script src="<?php echo site_url('assets/front/intercursos/js/main.js'); ?>?cache=<?php echo time(); ?>"></script>

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

    <?php if (!empty($this->session->userdata('account_id'))) {
        echo '<script>currentLogLogin("' . base_url() . '")</script>';
    } ?>

    <div class="overlay">
        <div class="load"></div>
    </div>

    <div class="areaMenuResponsivo">
        <div class="overflow">
            <div class="menuResponsivo">
                <div class="btMenuFechar efeito-01"><i class="fa fa-arrow-right"></i></div>
                <ul class="sub-menu">
                    <?php foreach ($page_menu as $k => $v) {
                        if ($k == 0) {

                            echo '
                            <li class="nav-item">
                                <a class="nav-link"  href="javascript:;" >' . $v['label'] . '</a>
                                <ul class="sub-menu">
                                    <li><a class="nav-link" href="'.base_url().'graduacao">Medicina Veterinária - SP</a></li>
                                </ul>
                            </li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link" href="' . $v['url'] . '">' . $v['label'] . '</a></li>';
                        }
                    } ?>

                </ul>
            </div>
        </div>
    </div>

    <div class="header">
        <div class="header-top">
            <div class="container">
                <div class="row-custom">
                    <div class="cols l">
                        <a href="<?php echo site_url(); ?>">
                            <img src="<?php echo site_url('assets/front/intercursos/img/2025/logo-faculdade-ufape.png') ?>">
                        </a>
                    </div>
                    <div class="cols m">
                        <form class="form" method="get" action="<?php echo base_url('produto/busca') ?>">
                            <input type="text" name="title" placeholder="Digite o nome do curso que está procurando" class="cp search" value="<?php echo @$_GET['title'] ?>">
                            <button type="submit" class="search-bt"></button>
                        </form>
                    </div>
                    <div class="cols r lk-dif">
                        <div class="lk"> <a href="https://faculdade.ufape.com.br/account/login">Portal <br> do aluno</a></div>
                    </div>
                    <div class="cols r">
                        <div class="lks-mini-cart">

                            <div class="lk-dif-r">
                                <div class="lk"> <a href="https://faculdade.ufape.com.br/account/login">Portal <br> do aluno</a></div>
                            </div>

                            <div class="dropdown_">

                                <button type="button" class="mini-cart" id="dropdownMiniCart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $cart['info']['numero_items'] . ' ' . ($cart['info']['numero_items'] <= 1 ? 'Item' : 'Itens'); ?>
                                </button>

                                <div class="dropdown-menu c-mini-cart" aria-labelledby="dropdownMiniCart">
                                    <div class="items">

                                        <?php if ($cart['info']['numero_items'] > 0): ?>

                                            <?php foreach ($cart['items'] as $v): ?>

                                                <div class="item">
                                                    <a href="<?php echo site_url('cart/remove/' . $v['id']); ?>" class="remove"><i class="fas fa-times"></i></a>
                                                    <div class="title"><?php echo $v['title']; ?></div>
                                                    <div class="price">R$

                                                        <?php

                                                        if (
                                                            $v['special_price'] != null and
                                                            $v['special_price'] != 0  and
                                                            (
                                                                (date('Y-m-d') >= $v['special_price_dt_start'] and date('Y-m-d') <= $v['special_price_dt_limit']) or
                                                                (is_null($v['special_price_dt_start']) and date('Y-m-d') <= $v['special_price_dt_limit']) or
                                                                (date('Y-m-d') >= $v['special_price_dt_start'] and is_null($v['special_price_dt_limit'])) or
                                                                (is_null($v['special_price_dt_start']) and is_null($v['special_price_dt_limit']))
                                                            )
                                                        ):

                                                            echo number_format($v['special_price'], 2, ",", ".");

                                                        else:

                                                            echo number_format($v['price'], 2, ",", ".");

                                                        endif;

                                                        ?>

                                                    </div>
                                                </div>

                                            <?php endforeach; ?>

                                        <?php else: ?>

                                            <div class="item nenhum">O carrinho está vazio</div>

                                        <?php endif; ?>

                                    </div>
                                    <div class="subtotal">
                                        <div class="lab">subtotal</div>
                                        <div class="val">R$ <span class="mini-val"><?php echo number_format($cart['info']['subtotal'], 2, ",", "."); ?></span></div>
                                    </div>
                                    <div class="bts">
                                        <a href="<?php echo site_url('cart'); ?>" class="icon-checkout">Finalizar compra</a>
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
                        <?php foreach ($page_menu as $k => $v) {
                            if ($k == 0) {
                                echo '<li>
                                        <a href="javascript:;">
                                        ' . $v['label'] . '

                                        </a>
                                        <ul>
                                            <li><a class="nav-link" href="'.base_url().'graduacao">Medicina Veterinária - SP</a></li>
                                        </ul>

                                    </li>';
                            } else {
                                echo '<li><a href="' . $v['url'] . '">' . $v['label'] . '</a></li>';
                            }
                        } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
