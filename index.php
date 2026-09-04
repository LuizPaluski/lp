<?php
require __DIR__ . '/includes/dados.php';
require __DIR__ . '/includes/conteudo.php';

$lote = LOTE_VIGENTE;
$outro_lote = $lote === '1' ? '2' : '1';

// Dentro do sistema da faculdade a página é uma view do CodeIgniter e usa o cabeçalho
// institucional; solta no Apache, usa o cabeçalho próprio desta pasta. Se o controller
// que carregar esta view já montar header e footer, apague os dois require abaixo.
$no_sistema = function_exists('site_url');
$lp = $no_sistema ? rtrim(base_url(PASTA_NO_SITE), '/') : '.';

require __DIR__ . ($no_sistema ? '/includes/header-sistema.php' : '/includes/header.php');
?>

<section class="hero">
    <div class="lp-container">
        <div>
            <span class="selo-evento">10 e 11 de outubro de 2026</span>
            <h1>Simpósio Plantonista Veterinário UFAPE</h1>
            <p class="subtitulo">O Paciente Cardiológico</p>
            <p class="chamada">
                Do atendimento inicial ao manejo avançado: um simpósio prático para o veterinário reconhecer,
                estabilizar, acompanhar e tomar decisões em pacientes cardiológicos, cães e gatos.
            </p>
            <p class="publico"><strong>Público alvo:</strong> médicos veterinários e acadêmicos de medicina veterinária.</p>
            <ul class="selos">
                <?php foreach ($selos as $selo): ?>
                    <li><?= $selo ?></li>
                <?php endforeach; ?>
            </ul>
            <div class="bts">
                <a class="bt bt-claro" href="#investimento">Garantir minha vaga</a>
                <a class="bt bt-linha" href="#programacao">Ver programação</a>
            </div>
        </div>
        <div class="foto">
            <img src="<?= $lp ?>/assets/img/hero-vet-portrait.jpg" alt="Médica veterinária avaliando paciente durante atendimento">
        </div>
    </div>
</section>

<div class="faixa-numeros">
    <dl class="lp-container">
        <?php foreach ($numeros as $rotulo => $valor): ?>
            <div>
                <dt><?= $rotulo ?></dt>
                <dd><?= $valor ?></dd>
            </div>
        <?php endforeach; ?>
    </dl>
</div>

<section class="secao">
    <div class="lp-container">
        <div class="publico-alvo">
            <div>
                <span class="chapeu">Para quem é</span>
                <h2>Para quem decide à beira do leito</h2>
                <p>
                    Voltado a médicos-veterinários, pós-graduandos, alunos de cursos de aperfeiçoamento e estudantes de
                    Medicina Veterinária que desejam aprofundar a abordagem clínica, anestésica, intensiva e diagnóstica
                    do paciente cardiológico.
                </p>
                <p>
                    Especialmente indicado para quem atua em clínica médica, cardiologia, anestesiologia, emergência,
                    UTI e internação de cães e gatos com suspeita ou diagnóstico de cardiopatia.
                </p>
            </div>
            <ul class="lista-diferenciais">
                <?php foreach ($diferenciais as $item): ?>
                    <li><?= $item ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>

<section class="secao cinza" id="programacao">
    <div class="lp-container">
        <h2 class="titulo-secao">Programação <span>científica</span></h2>
        <p class="intro">Dois dias de raciocínio clínico aplicado, com 16 horas de programação.</p>

        <?php foreach ($programacao as $data => $linhas): ?>
            <h3 class="dia"><?= $data ?></h3>
            <div class="agenda">
                <?php foreach ($linhas as [$hora, $atividade, $quem]): ?>
                    <div class="linha">
                        <span class="hora"><?= $hora ?></span>
                        <span class="atividade"><?= $atividade ?></span>
                        <span class="palestrante">
                            <?php foreach (retratos_da_linha($quem) as $retrato): ?>
                                <img src="<?= $lp ?>/assets/img/<?= $retrato ?>" alt="" loading="lazy">
                            <?php endforeach; ?>
                            <?= $quem ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="secao" id="workshops">
    <div class="lp-container">
        <span class="chapeu">09 de outubro de 2026, pré-simpósio</span>
        <h2 class="titulo-secao">Workshops <span>hands on</span></h2>
        <p class="intro">Turmas reduzidas, com prática in vivo. Inscrição independente do simpósio.</p>

        <div class="fotos-clinica">
            <figure>
                <img src="<?= $lp ?>/assets/img/clinica-1.jpg" alt="Veterinário demonstrando ecocardiografia em paciente monitorado durante aula prática" loading="lazy">
                <figcaption>Demonstração de POCUS e monitorização hemodinâmica com o paciente ao vivo.</figcaption>
            </figure>
            <figure>
                <img src="<?= $lp ?>/assets/img/clinica-2.jpg" alt="Equipe veterinária acompanhando pacientes internados em UTI com ventilação mecânica" loading="lazy">
                <figcaption>Rotina de UTI, ventilação mecânica e manejo do cardiopata crítico.</figcaption>
            </figure>
        </div>

        <div class="grade-workshops">
            <?php foreach ($workshops_opcionais as $id => $ws): ?>
                <?php $detalhe = $workshops_detalhe[$id]; ?>
                <article class="lp-card card-workshop">
                    <h3><?= $ws['titulo'] ?></h3>
                    <div class="meta">
                        <span class="valor"><?= formatar_brl($ws['valor']) ?></span>
                        <span class="vagas"><?= $detalhe['vagas'] ?></span>
                    </div>
                    <ul>
                        <?php foreach ($detalhe['itens'] as [$hora, $atividade, $quem]): ?>
                            <li>
                                <span class="hora"><?= $hora ?></span>
                                <span>
                                    <?= $atividade ?>
                                    <span class="quem"><?= $quem ?></span>
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="secao cinza" id="investimento">
    <div class="lp-container">
        <h2 class="titulo-secao">Escolha a sua <span>modalidade</span></h2>
        <p class="intro">
            Valores do <?= $lote === '1' ? 'primeiro' : 'segundo' ?> lote. Pagamento via Pix, boleto à vista
            ou cartão em até 3x sem juros (4 a 10x com juros).
        </p>

        <div class="grade-precos">
            <?php foreach ($modalidades as $id => $modalidade): ?>
                <article class="lp-card card-preco">
                    <h3><?= $modalidade['titulo'] ?></h3>
                    <?php $doacao = str_contains($modalidade['nota'], 'doação'); ?>
                    <p class="nota <?= $doacao ? 'destaque' : '' ?>">
                        <?php if ($doacao): ?><strong>Ação social:</strong> <?php endif; ?><?= $modalidade['nota'] ?>
                    </p>
                    <div class="valores">
                        <?php foreach ($categorias as $cat_id => $cat_label): ?>
                            <div>
                                <p class="publico"><?= $cat_label ?></p>
                                <p class="preco">
                                    <b><?= formatar_brl($modalidade['precos'][$cat_id][$lote]) ?></b>
                                    <?php if ($lote === '1'): ?>
                                        <s>2º lote <?= formatar_brl($modalidade['precos'][$cat_id][$outro_lote]) ?></s>
                                    <?php endif; ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="bt js-abrir-popup" data-modalidade="<?= $id ?>">Quero esta modalidade</button>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="inclusos">
            <?php foreach ($inclusos as $item): ?>
                <p><?= $item ?></p>
            <?php endforeach; ?>
        </div>

        <p class="aviso-lote">
            Ex-alunos UFAPE têm condições específicas e são atendidos pela secretaria no WhatsApp para confirmação do vínculo.
        </p>
    </div>
</section>

<section class="secao" id="palestrantes">
    <div class="lp-container">
        <span class="chapeu">Corpo docente</span>
        <h2 class="titulo-secao">Palestrantes <span>confirmados</span></h2>
        <div class="grade-palestrantes">
            <?php foreach ($palestrantes as $p): ?>
                <article class="lp-card card-palestrante">
                    <img src="<?= $lp ?>/assets/img/<?= $p['foto'] ?>" alt="Retrato de <?= $p['nome'] ?>" loading="lazy">
                    <h3><?= $p['nome'] ?></h3>
                    <p><?= $p['tema'] ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="secao cinza" id="faq">
    <div class="lp-container">
        <h2 class="titulo-secao">Dúvidas <span>frequentes</span></h2>
        <div class="faq">
            <?php foreach ($faq as [$pergunta, $resposta]): ?>
                <details>
                    <summary><?= $pergunta ?></summary>
                    <p class="resposta"><?= $resposta ?></p>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="chamada-final">
    <div class="lp-container">
        <h2>Vagas presenciais limitadas a 260 pessoas</h2>
        <p>10 e 11 de outubro de 2026, Av. Tiradentes, 11, São Paulo/SP. Transmissão online pela plataforma Vimeo.</p>
        <a class="bt bt-claro" href="#investimento">Fazer minha inscrição</a>
    </div>
</section>

<?php
require __DIR__ . '/includes/popup-inscricao.php';
require __DIR__ . ($no_sistema ? '/includes/footer-sistema.php' : '/includes/footer.php');
