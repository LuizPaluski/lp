<?php
$esquema = ($_SERVER['HTTPS'] ?? 'off') === 'off' ? 'http' : 'https';
// a página roda numa subpasta do site da faculdade, então a base inclui o diretório
$url_base = $esquema . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simpósio Plantonista Veterinário UFAPE | Cardiologia 2026</title>
    <meta name="description" content="Simpósio Plantonista Veterinário UFAPE, Edição Cardiologia. 10 e 11 de outubro de 2026, em São Paulo. Presencial e online gravado por 12 meses.">
    <meta property="og:title" content="Simpósio Plantonista Veterinário UFAPE, Cardiologia">
    <meta property="og:description" content="Do atendimento inicial ao manejo avançado do paciente cardiológico. 10 e 11 de outubro de 2026, híbrido, com certificado UFAPE.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= $url_base ?>/assets/img/hero-vet-portrait.jpg">
    <meta property="og:url" content="<?= $url_base ?>/">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="icon" href="<?= $lp ?>/assets/img/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="<?= $lp ?>/assets/css/style.css">
</head>
<body>

<div class="lp-topo">
    <div class="lp-container">
        <a class="logo" href="https://faculdade.ufape.com.br/">
            <img src="<?= $lp ?>/assets/img/logo-faculdade-ufape.png" alt="Faculdade Ufape">
        </a>
        <div class="acoes">
            <a class="lp-portal" href="https://faculdade.ufape.com.br/account/login">Portal<br>do aluno</a>
        </div>
    </div>
</div>
