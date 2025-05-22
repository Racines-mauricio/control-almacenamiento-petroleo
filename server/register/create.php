<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

require '../commons/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        !empty($_POST['due_date']) &&
        !empty($_POST['user_id']) &&
        !empty($_POST['id_fuel']) &&
        isset($_POST['quantity_barrel'])
    ) {
        try {
            $q = "INSERT INTO register_fuel.register (due_date, quantity_barrel, id_fuel, user_id) VALUES (:due_date, :quantity_barrel, :id_fuel, :user_id)";
            $stmt = $db->prepare($q);
            $stmt->execute([
                "due_date" => $_POST["due_date"],
                "quantity_barrel" => $_POST["quantity_barrel"],
                "id_fuel" => $_POST["id_fuel"],
                "user_id" => $_POST["user_id"]
            ]);
            echo json_encode(['success' => true, 'message' => 'Registro creado correctamente']);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error en la conexión: ' . $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios']);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
