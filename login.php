<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        echo "Por favor, preencha email e password.";
        exit;
    }

  
    $db = new SQLite3('dados.db'); 


    $stmt = $db->prepare('SELECT id, email, password, tipo FROM utilizadores WHERE email = :email');
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();

    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user) {

        if ($password === $user['password']) {
         
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_tipo'] = $user['tipo'];

            
            header('Location: dashboard.php');
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
