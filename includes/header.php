<?php
$esquema = ($_SERVER['HTTPS'] ?? 'off') === 'off' ? 'http' : 'https';
$url_base = $esquema . '://' . $_SERVER['HTTP_HOST'];
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
    <link rel="icon" href="assets/img/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="header-top">
    <div class="container">
        <a class="logo" href="https://faculdade.ufape.com.br/">
            <img src="assets/img/logo-faculdade-ufape.png" alt="Faculdade Ufape">
        </a>
        <div class="acoes">
            <a class="portal-aluno" href="https://faculdade.ufape.com.br/account/login">Portal<br>do aluno</a>
        </div>
    </div>
</div>

<div class="header-menu">
    <div class="container">
        <nav>
            <a href="#programacao">Programação</a>
            <a href="#workshops">Workshops</a>
            <a href="#investimento">Investimento</a>
            <a href="#palestrantes">Palestrantes</a>
            <a href="#faq">Dúvidas</a>
        </nav>
        <a class="bt-topo" href="#investimento">Inscreva-se</a>
    </div>
</div>
