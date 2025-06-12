<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $telemovel = trim($_POST['telemovel'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $morada = trim($_POST['morada'] ?? '');

    if (empty($nome)) {
        echo "Nome é obrigatório.";
        exit;
    }

    try {
        $db = new SQLite3('../database/dados.db');
        $stmt = $db->prepare('INSERT INTO funcionarios (nome, telemovel, email, morada) VALUES (:nome, :telemovel, :email, :morada)');
        $stmt->bindValue(':nome', $nome, SQLITE3_TEXT);
        $stmt->bindValue(':telemovel', $telemovel, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':morada', $morada, SQLITE3_TEXT);
        $stmt->execute();

        header('Location: ../funcionarios.php');
        exit;
    } catch (Exception $e) {
        echo "Erro: " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "Método inválido.";
}