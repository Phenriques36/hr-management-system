<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        echo "Por favor, preencha email e password.";
        exit;
    }

    $db = new SQLite3('../database/dados.db'); 
    date_default_timezone_set('Europe/Lisbon');

  
    $stmt = $db->prepare('SELECT id, nome, email, password, tipo FROM utilizadores WHERE email = :email');
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();

    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user) {
   
        if ($password === $user['password']) {
          
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_tipo'] = $user['tipo'];
            $_SESSION['user_nome'] = $user['nome'];

          
            $agora = date('Y-m-d H:i:s');
            $stmtUpdate = $db->prepare('UPDATE utilizadores SET ultimo_acesso = :ultimo_acesso WHERE id = :id');
            $stmtUpdate->bindValue(':ultimo_acesso', $agora, SQLITE3_TEXT);
            $stmtUpdate->bindValue(':id', $user['id'], SQLITE3_INTEGER);
            $stmtUpdate->execute();

            
            header('Location: ../dashboard.html');
            exit;
        } else {
            echo "Password incorreta.";
        }
    } else {
        echo "Email não encontrado.";
    }
} else {
    echo "Método inválido.";
}
?>
