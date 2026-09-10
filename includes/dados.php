<?php
// Conteúdo e tabela de preços do Simpósio Plantonista Veterinário UFAPE, edição Cardiologia.
// Valores em centavos para não arrastar erro de arredondamento.

date_default_timezone_set('America/Sao_Paulo');

// Lote vigente na tabela de preços. Trocar para '2' no mesmo dia em que os valores
// forem atualizados no carrinho da faculdade: a página não pode anunciar um preço
// diferente do que o checkout cobra.
const LOTE_VIGENTE = '1';

// Pasta em que a página fica publicada dentro do site da faculdade.
const PASTA_NO_SITE = 'simposio-plantonista';

const CHECKOUT_BASE = 'https://faculdade.ufape.com.br/cart/add';
const WEBHOOK_INSCRICAO = 'https://webhook.thegrowthhub.app.br/webhook/4ded9a37-413e-4c04-a6f0-ac3d554bb0a7';

// A condição de aluno e ex-aluno é o valor de demais participantes com desconto.
const DESCONTO_EX_ALUNO = 0.20;

// Condição que exige cupom para comprovar o vínculo com a UFAPE.
const CATEGORIA_COM_CUPOM = 'pos';

// Cupom em espera: ligar de novo é trocar para true, o campo volta ao popup e o
// cupom.php passa a ser consultado.
const PEDE_CUPOM = false;

// Cupons aceitos na condição de aluno e ex-aluno, os mesmos códigos cadastrados no
// carrinho da faculdade. Enquanto a lista estiver vazia o popup aceita o código
// digitado e deixa a conferência para o checkout, que é onde o desconto é aplicado.
$cupons = ['cupomteste20'];

$categorias = [
    'pos'   => 'Alunos e Ex-Alunos da Pós Graduação Ufape',
    'geral' => 'Demais participantes',
];

// checkout_id é o id do curso no carrinho da faculdade (cart/add/<ids separados por
// hífen>). Toda inscrição vai pelo valor cheio: o desconto de aluno e ex-aluno sai do
// cupom aplicado no carrinho, não de um produto mais barato. O carrinho também tem
// produto próprio de ex-aluno (68630 presencial, 68631 com gravação, 68633 online); se
// um dia a inscrição voltar a passar por eles, é acrescentar 'pos' => '<id>' aqui.
$modalidades = [
    'presencial' => [
        'titulo'      => 'Presencial',
        'nota'        => 'Inclui doação de brinquedo.',
        'checkout_id' => ['geral' => '68619'],
        'precos'      => [
            'geral'  => ['1' => 26000, '2' => 31200],
        ],
    ],
    'presencial_gravacao' => [
        'titulo'      => 'Presencial + gravação (12 meses)',
        'nota'        => 'Inclui doação de brinquedo. Em caso de não comparecimento, será cobrada taxa de R$ 25 referente ao brinquedo.',
        'checkout_id' => ['geral' => '68620'],
        'precos'      => [
            'geral'  => ['1' => 47000, '2' => 56400],
        ],
    ],
    'online' => [
        'titulo'      => 'Online transmitido e gravado',
        'nota'        => 'Acesso por 12 meses.',
        'checkout_id' => ['geral' => '68621'],
        'precos'      => [
            'geral'  => ['1' => 38000, '2' => 45600],
        ],
    ],
];

$workshops_opcionais = [
    'balonamento'      => ['titulo' => 'Balonamento arterial pulmonar (09/10)',       'valor' => 198000, 'checkout_id' => '68624'],
    'hemodinamica'     => ['titulo' => 'Hemodinâmica básica e avançada (09/10)',      'valor' => 115000, 'checkout_id' => '68625'],
    'atriosseptostomia'=> ['titulo' => 'Atriosseptostomia (09/10)',                   'valor' => 348000, 'checkout_id' => '68626'],
    'ventilacao'       => ['titulo' => 'Ventilação mecânica no ICC esquerdo (09/10)', 'valor' => 135000, 'checkout_id' => '68627'],
];

function formatar_brl(int $centavos): string
{
    return 'R$ ' . number_format($centavos / 100, 2, ',', '.');
}

function valor_categoria(string $modalidade, string $categoria, string $lote): int
{
    global $modalidades;

    $cheio = $modalidades[$modalidade]['precos']['geral'][$lote];

    return $categoria === CATEGORIA_COM_CUPOM
        ? (int) round($cheio * (1 - DESCONTO_EX_ALUNO))
        : $cheio;
}

function desconto_em_texto(): string
{
    return (int) round(DESCONTO_EX_ALUNO * 100) . '% de desconto usando o cupom';
}

function total_centavos(string $modalidade, string $categoria, array $workshops, string $lote): int
{
    global $workshops_opcionais;

    $total = valor_categoria($modalidade, $categoria, $lote);
    foreach ($workshops as $id) {
        if (isset($workshops_opcionais[$id])) {
            $total += $workshops_opcionais[$id]['valor'];
        }
    }
    return $total;
}

// UTMs que marcam a inscrição como vinda desta landing page.
function utm_checkout(string $lote): string
{
    return http_build_query([
        'utm_source'   => 'lp-simposio-plantonista',
        'utm_medium'   => 'popup-inscricao',
        'utm_campaign' => "simposio-cardiologia-{$lote}o-lote",
    ]);
}

// Link do carrinho com a modalidade e os workshops escolhidos.
function cupom_valido(string $codigo): bool
{
    global $cupons;

    if ($cupons === []) {
        return trim($codigo) !== '';
    }

    return in_array(strtoupper(trim($codigo)), array_map('strtoupper', $cupons), true);
}

function checkout_id(string $modalidade, string $categoria): string
{
    global $modalidades;

    $ids = $modalidades[$modalidade]['checkout_id'];

    return $ids[$categoria] ?? $ids['geral'];
}

function url_checkout(string $modalidade, string $categoria, array $workshops, string $lote): string
{
    global $workshops_opcionais;

    $ids = [checkout_id($modalidade, $categoria)];
    foreach ($workshops as $id) {
        if (isset($workshops_opcionais[$id])) {
            $ids[] = $workshops_opcionais[$id]['checkout_id'];
        }
    }

    return CHECKOUT_BASE . '/' . implode('-', $ids) . '?' . utm_checkout($lote);
}
