<?php
// Só entram no JSON os palestrantes com currículo cadastrado; a chave é o índice
// do card em $palestrantes.
$cv_palestrantes = [];
foreach ($palestrantes as $i => $p) {
    if (isset($curriculos[$p['nome']])) {
        $cv_palestrantes[$i] = [
            'nome' => $p['nome'],
            'tema' => $p['tema'],
            'foto' => $lp . '/assets/img/' . $p['foto'],
            'cv'   => $curriculos[$p['nome']],
        ];
    }
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
window.CURRICULOS = <?= json_encode($cv_palestrantes, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
</script>
