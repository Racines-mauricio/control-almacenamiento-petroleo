<?php
session_start();
require '../commons/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $db->prepare("SELECT * FROM register_fuel.usr WHERE email = :email AND password = :pwd");
    $stmt->execute([
        'email' => $email,
        'pwd' => $password
    ]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($user)) {
        $_SESSION['id_user'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: /control-almacenamiento-petroleo/index.php');
        exit;
    } else {
        header('Location: login.php?error=1');
        exit;
    }
}
