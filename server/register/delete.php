<?php
header('Content-Type: application/json');
require '../commons/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if (!$id) {
        http_response_code(400);
        echo json_encode(['error' => 'ID no proporcionado']);
        exit;
    }

    try {
        $stmt = $db->prepare("DELETE FROM register_fuel.register WHERE id = :id");
        $stmt->execute(['id' => $id]);

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Error al eliminar: ' . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
}
