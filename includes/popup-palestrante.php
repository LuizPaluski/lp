<?php
// O modal atende as duas grades (palestrantes e professores dos workshops), então a
// chave é o nome. O tema vem do botão, porque o mesmo professor pode aparecer nas duas.
$cv_modal = [];
foreach ($curriculos as $nome => $cv) {
    $foto = $fotos_palestrantes[$nome] ?? '';
    $cv_modal[$nome] = [
        'nome' => $nome,
        'foto' => $foto ? $lp . '/assets/img/' . $foto : '',
        'cv'   => $cv,
    ];
}
?>
<div class="popup popup-cv" id="popup-palestrante" role="dialog" aria-modal="true" aria-labelledby="cv-nome">
    <div class="caixa">
        <div class="topo">
            <div>
                <h2 id="cv-nome" class="js-cv-nome"></h2>
                <p class="js-cv-tema"></p>
            </div>
            <button type="button" class="fechar js-fechar-cv" aria-label="Fechar">&times;</button>
        </div>

        <div class="corpo">
            <img class="retrato-cv js-cv-foto" src="" alt="" width="110" height="110">
            <ul class="lista-cv js-cv-itens"></ul>
        </div>
    </div>
</div>

<script>
window.CURRICULOS = <?= json_encode($cv_modal, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
</script>
