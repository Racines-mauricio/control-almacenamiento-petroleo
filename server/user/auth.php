<?php
session_start();
require '../commons/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $db->prepare("SELECT * FROM oil_barrel_control.usr WHERE email = :email AND password = :pwd");
    $stmt->execute([
        'email' => $email,
        'pwd' => $password
    ]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($user)) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: /control-almacenamiento-petroleo/index.html');
        exit;
    } else {
        header('Location: login.php?error=1');
        exit;
    }
}
