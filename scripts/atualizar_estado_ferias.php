<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $estado = $_POST['estado'];
    if (in_array($estado, ['pendente', 'aprovado', 'rejeitado'])) {
        $db = new SQLite3('../database/dados.db');
        $stmt = $db->prepare("UPDATE pedidos_ferias SET estado = :estado WHERE id = :id");
        $stmt->bindValue(':estado', $estado, SQLITE3_TEXT);
        $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        if ($result) {
            echo "ok";
        } else {
            echo "erro";
        }
    } else {
        echo "estado inválido";
    }
} else {
    echo "método inválido";
}