<?php
header('Content-Type: application/json');

try {
    $dbPath = realpath('../database/dados.db');
    if (!$dbPath || !file_exists($dbPath)) {
        throw new Exception('Base de dados não encontrada em: ' . $dbPath);
    }

    $db = new SQLite3($dbPath);

    $query = 'SELECT COUNT(*) AS total FROM funcionarios';
    $result = $db->query($query);

    if (!$result) {
        throw new Exception('Erro na execução da query.');
    }

    $row = $result->fetchArray(SQLITE3_ASSOC);

    if (!$row || !isset($row['total'])) {
        throw new Exception('Erro ao obter dados da query.');
    }

    echo json_encode(['total' => $row['total']]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>

