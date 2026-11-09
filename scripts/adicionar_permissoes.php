<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['funcionario']) || empty($data['nivel'])) {
    echo json_encode(['success' => false, 'error' => 'Dados incompletos.']);
    exit;
}

try {
    $db = new PDO('sqlite:../database/dados.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $modulo = 'RH';
    $funcionario_id = $data['funcionario'];

    // Directly use the funcionario ID as id_utilizador
    $stmt = $db->prepare("INSERT INTO permissoes (id_utilizador, modulo, nivel) VALUES (?, ?, ?)");
    $stmt->execute([$funcionario_id, $modulo, $data['nivel']]);

    echo json_encode(['success' => true, 'message' => 'Permissão adicionada com sucesso!']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Erro ao adicionar permissão: ' . $e->getMessage()]);
}
?>