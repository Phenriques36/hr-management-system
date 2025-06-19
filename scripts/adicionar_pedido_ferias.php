<?php
// filepath: scripts/adicionar_pedido_ferias.php
header('Content-Type: application/json');
session_start();

$data = json_decode(file_get_contents('php://input'), true);
if (
    empty($data['id_funcionario']) ||
    empty($data['data_inicio']) ||
    empty($data['data_fim']) ||
    empty($data['tipo'])
) {
    echo json_encode(['success' => false, 'error' => 'Dados incompletos.']);
    exit;
}

try {
    $db = new PDO('sqlite:../database/dados.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id_funcionario = $data['id_funcionario'];
    $data_inicio = $data['data_inicio'];
    $data_fim = $data['data_fim'];
    $tipo = $data['tipo'];
    $estado = 'pendente';

    $stmt = $db->prepare("INSERT INTO pedidos_ferias (id_funcionario, data_inicio, data_fim, tipo, estado) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$id_funcionario, $data_inicio, $data_fim, $tipo, $estado]);

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}