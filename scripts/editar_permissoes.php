<?php
// filepath: c:\xampp\htdocs\scripts\editar_permissoes.php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (empty($data['id']) || empty($data['funcionario']) || empty($data['nivel'])) {
    echo json_encode(['success' => false, 'error' => 'Dados incompletos.']);
    exit;
}

try {
    $db = new PDO('sqlite:../database/dados.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $funcionario_id = $data['funcionario'];

    $stmt = $db->prepare("UPDATE permissoes SET id_utilizador = ?, nivel = ? WHERE id = ?");
    $stmt->execute([$funcionario_id, $data['nivel'], $data['id']]);

    echo json_encode(['success' => true, 'message' => 'Permissão atualizada com sucesso!']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Erro ao atualizar permissão: ' . $e->getMessage()]);
}
?>