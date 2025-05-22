<?php
require '../commons/db.php';

// Indicamos que la respuesta será JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    if (
        !empty($data['id']) &&
        !empty($data['due_date']) &&
        !empty($data['quantity_barrel']) &&
        !empty($data['id_fuel'])
    ) {
        try {
            $stmt = $db->prepare("UPDATE register_fuel.register SET due_date = :due_date, quantity_barrel = :quantity_barrel, id_fuel = :id_fuel WHERE id = :id");
            $stmt->execute([
                'due_date' => $data['due_date'],
                'quantity_barrel' => $data['quantity_barrel'],
                'id_fuel' => $data['id_fuel'],
                'id' => $data['id']
            ]);
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Faltan campos']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
}
?>
