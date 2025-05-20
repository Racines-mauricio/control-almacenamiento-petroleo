<?php
require '../commons/db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['user_id'])) {
        try {
            $user_id = $_GET['user_id'];
            $q = "SELECT id, type, create_at FROM register_fuel.fuel WHERE user_id = :usr_id ORDER BY create_at DESC";
            $stmt = $db->prepare($q);
            $stmt->execute([
                "usr_id" => $user_id
            ]);
            $type_fuel = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($type_fuel);
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Error en la conexión: ' . $e->getMessage()]);
            exit();
        }
    } else {
        echo json_encode(["error" => "No param"]);
    }
} else {
    echo json_encode(["error" => "Bad Request"]);
}
?>
