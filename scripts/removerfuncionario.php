<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id'] ?? 0);

    if ($id <= 0) {
        echo "ID inválido.";
        exit;
    }

    try {
        $db = new SQLite3('../database/dados.db');
        $stmt = $db->prepare('DELETE FROM funcionarios WHERE id = :id');
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $stmt->execute();

        header('Location: ../funcionarios.php');
        exit;
    } catch (Exception $e) {
        echo "Erro ao remover funcionário: " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "Método inválido.";
}
?>
