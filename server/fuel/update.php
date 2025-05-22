<?php
require '../commons/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $type = $_POST['type'] ?? '';
    $user_id = $_POST['user_id'] ?? '';

    if (trim($id) === '' || trim($type) === '' || trim($user_id) === '') {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    try {
        $q = "UPDATE register_fuel.fuel SET type = :type WHERE id = :id AND user_id = :user_id";
        $stmt = $db->prepare($q);
        $stmt->execute([
            ':type' => $type,
            ':id' => $id,
            ':user_id' => $user_id
        ]);

        echo json_encode(['success' => true, 'message' => 'Combustible actualizado correctamente.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
