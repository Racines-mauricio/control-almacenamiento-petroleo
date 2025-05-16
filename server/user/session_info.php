<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['id_user'])) {
    echo json_encode([
        'id_user' => $_SESSION['id_user'],
        'user_name' => $_SESSION['user_name']
    ]);
} else {
    echo json_encode(['error' => 'No hay sesión activa']);
}