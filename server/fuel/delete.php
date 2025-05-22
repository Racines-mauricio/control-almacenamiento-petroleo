<?php
require '../commons/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $user_id = $_POST['user_id'] ?? '';

    if (trim($id) === '' || trim($user_id) === '') {
        echo json_encode(['success' => false, 'message' => 'ID y user_id son requeridos.']);
        exit;
    }

    try {
        $q = "DELETE FROM register_fuel.fuel WHERE id = :id AND user_id = :user_id";
        $stmt = $db->prepare($q);
        $stmt->execute([
            ':id' => $id,
            ':user_id' => $user_id
        ]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Combustible eliminado exitosamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se encontró el registro para eliminar.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
