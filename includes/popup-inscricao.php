<?php $lote = lote_vigente(); ?>
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
                <div class="campo">
                    <span class="rotulo">Você é</span>
                    <?php foreach ($categorias as $id => $label): ?>
                        <label class="opcao">
                            <input type="radio" name="categoria" value="<?= $id ?>" <?= $id === 'geral' ? 'checked' : '' ?>>
                            <span class="titulo"><?= $label ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>

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
                    <div><strong>Categoria:</strong> <span class="js-resumo-categoria"></span></div>
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

<script>
window.SIMPOSIO = <?= json_encode([
    'lote'          => $lote,
    'checkoutBase'  => CHECKOUT_BASE,
    'utm'           => utm_checkout($lote),
    'whatsapp'      => WHATSAPP_SECRETARIA,
    'comVinculo'    => CATEGORIAS_COM_VINCULO,
    'categorias'    => $categorias,
    'modalidades'   => array_map(fn($m) => [
        'titulo'     => $m['titulo'],
        'checkoutId' => $m['checkout_id'],
        'precos'     => array_map(fn($p) => $p[$lote], $m['precos']),
    ], $modalidades),
    'workshops'     => array_map(fn($w) => [
        'titulo'     => $w['titulo'],
        'checkoutId' => $w['checkout_id'],
        'valor'      => $w['valor'],
    ], $workshops_opcionais),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
</script>
