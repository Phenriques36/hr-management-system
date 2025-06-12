<?php
try {
    $dbPath = $_SERVER['DOCUMENT_ROOT'] . '../database/dados.db';
    $db = new SQLite3($dbPath);

    $query = 'SELECT COUNT(*) AS total FROM funcionarios';
    $result = $db->querySingle($query, true);

    echo htmlspecialchars($result['total']);
    
    $db->close();
} catch (Exception $e) {
    echo "Erro";
}
?>