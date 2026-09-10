<?php
// Card usado nas duas grades, de palestrantes e de professores dos workshops.
// Espera $p (nome, tema, foto) e $lp definidos por quem inclui.
$tem_cv = isset($curriculos[$p['nome']]);
?>
<article class="lp-card card-palestrante">
    <?php if ($p['foto']): ?>
        <img src="<?= $lp ?>/assets/img/<?= $p['foto'] ?>" alt="Retrato de <?= $p['nome'] ?>" loading="lazy">
    <?php else: ?>
        <span class="sem-retrato" aria-hidden="true"><?= iniciais($p['nome']) ?></span>
    <?php endif; ?>
    <h3><?= $p['nome'] ?></h3>
    <p><?= $p['tema'] ?></p>
    <?php if ($tem_cv): ?>
        <button type="button" class="ver-cv js-abrir-cv" data-quem="<?= $p['nome'] ?>" data-tema="<?= $p['tema'] ?>">Ver currículo</button>
    <?php endif; ?>
</article>
