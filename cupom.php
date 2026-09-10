<?php

require __DIR__ . '/includes/dados.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

$entrada = json_decode(file_get_contents('php://input'), true);
$codigo = trim($entrada['codigo'] ?? '');

header('Content-Type: application/json');
echo json_encode([
    'valido'    => cupom_valido($codigo),
    'conferido' => $cupons !== [],
]);
