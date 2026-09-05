<?php
// Recebe o lead do popup e repassa ao webhook. Os valores são recalculados aqui:
// o que vem do navegador é só a escolha, nunca o preço.

require __DIR__ . '/includes/dados.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

$entrada = json_decode(file_get_contents('php://input'), true);

$modalidade = $entrada['modalidade'] ?? '';
$categoria  = CATEGORIA_PADRAO;
$nome       = trim($entrada['nome'] ?? '');
$telefone   = trim($entrada['telefone'] ?? '');

if (!isset($modalidades[$modalidade])
    || mb_strlen($nome) < 3
    || strlen(preg_replace('/\D/', '', $telefone)) < 10) {
    http_response_code(422);
    exit;
}

$workshops = array_values(array_intersect(
    (array) ($entrada['workshops'] ?? []),
    array_keys($workshops_opcionais)
));

$lote  = LOTE_VIGENTE;
$total = total_centavos($modalidade, $categoria, $workshops, $lote);

$payload = [
    'nome'             => $nome,
    'telefone'         => $telefone,
    'categoria'        => $categoria,
    'categoria_label'  => $categorias[$categoria],
    'modalidade'       => $modalidade,
    'modalidade_label' => $modalidades[$modalidade]['titulo'],
    'workshops'        => array_map(fn($id) => $workshops_opcionais[$id]['titulo'], $workshops),
    'lote'             => $lote,
    'total_centavos'   => $total,
    'total_formatado'  => formatar_brl($total),
    'destino'          => 'checkout',
    'origem'           => mb_substr($entrada['origem'] ?? '', 0, 500),
    'enviado_em'       => date('c'),
];

$payload['checkout_url'] = url_checkout($modalidade, $workshops, $lote);

$ch = curl_init(WEBHOOK_INSCRICAO);
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => json_encode($payload, JSON_UNESCAPED_UNICODE),
    CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 8,
]);
$resposta = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($resposta === false || $status >= 400) {
    error_log("simposio: webhook respondeu $status na inscricao $modalidade/$categoria");
}

http_response_code(204);
