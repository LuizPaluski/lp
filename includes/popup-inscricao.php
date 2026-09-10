<?php $lote = LOTE_VIGENTE; ?>
<div class="popup" id="popup-inscricao" role="dialog" aria-modal="true" aria-labelledby="popup-titulo">
    <div class="caixa">
        <div class="topo">
            <div>
                <h2 id="popup-titulo">Garantir minha vaga</h2>
                <p>Modalidade: <strong class="js-modalidade"></strong></p>
            </div>
            <button type="button" class="fechar js-fechar" aria-label="Fechar">&times;</button>
        </div>

        <div class="corpo">
            <div class="etapa" data-etapa="1">
                <?php if (PEDE_CUPOM): ?>
                    <div class="campo">
                        <label class="rotulo-campo" for="cupom">Cupom de aluno ou ex-aluno da pós (opcional)</label>
                        <input class="entrada" type="text" id="cupom" maxlength="40" placeholder="Digite o cupom" autocomplete="off">
                        <p class="aviso js-aviso-cupom"></p>
                    </div>
                <?php endif; ?>

                <div class="campo">
                    <span class="rotulo">Workshops opcionais (09/10)</span>
                    <?php foreach ($workshops_opcionais as $id => $ws): ?>
                        <label class="opcao">
                            <input type="checkbox" name="workshop" value="<?= $id ?>">
                            <span class="titulo"><?= $ws['titulo'] ?></span>
                            <span class="valor"><?= formatar_brl($ws['valor']) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>

                <div class="rodape-popup">
                    <div class="total">
                        <span class="rotulo-total">Total (<?= $lote ?>º lote)</span>
                        <div class="numero js-total"></div>
                    </div>
                    <button type="button" class="bt bt-azul js-continuar">Continuar</button>
                </div>
            </div>

            <div class="etapa" data-etapa="2" hidden>
                <div class="resumo">
                    <?php if (PEDE_CUPOM): ?>
                        <div class="js-resumo-linha-cupom" hidden><strong>Cupom:</strong> <span class="js-resumo-cupom"></span></div>
                    <?php endif; ?>
                    <div><strong>Workshops:</strong> <span class="js-resumo-workshops"></span></div>
                    <div><strong>Total (<?= $lote ?>º lote):</strong> <span class="js-resumo-total"></span></div>
                </div>

                <div class="campo">
                    <label class="rotulo-campo" for="nome">Nome completo</label>
                    <input class="entrada" type="text" id="nome" maxlength="120" placeholder="Seu nome" autocomplete="name">
                </div>

                <div class="campo">
                    <label class="rotulo-campo" for="telefone">Telefone (WhatsApp)</label>
                    <input class="entrada" type="tel" id="telefone" maxlength="15" placeholder="(00) 00000-0000" inputmode="tel" autocomplete="tel">
                </div>

                <div class="rodape-popup">
                    <button type="button" class="bt-texto js-voltar">Voltar</button>
                    <button type="button" class="bt bt-azul js-enviar" disabled>Ir para o checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// o total sempre mostra o valor cheio: o desconto de ex-aluno sai do cupom no carrinho
$modalidades_popup = [];
foreach ($modalidades as $id => $m) {
    $modalidades_popup[$id] = [
        'titulo'      => $m['titulo'],
        'checkoutIds' => $m['checkout_id'],
        'preco'       => valor_cheio($id, $lote),
    ];
}
?>
<script>
window.SIMPOSIO = <?= json_encode([
    'lote'          => $lote,
    'endpoint'      => $lp . '/inscricao.php',
    'endpointCupom' => $lp . '/cupom.php',
    'comCupom'      => PEDE_CUPOM ? CATEGORIA_COM_CUPOM : '',
    'checkoutBase'  => CHECKOUT_BASE,
    'utm'           => utm_checkout($lote),
    'modalidades'   => $modalidades_popup,
    'workshops'     => array_map(fn($w) => [
        'titulo'     => $w['titulo'],
        'checkoutId' => $w['checkout_id'],
        'valor'      => $w['valor'],
    ], $workshops_opcionais),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
</script>
