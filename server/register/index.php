<?php
require '../commons/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['user_id'])) {
        try {
            $user_id = $_GET['user_id'];
            $q = "SELECT * FROM register_fuel.register WHERE user_id = :usr_id";
            $stmt = $db->prepare($q);
            $stmt->execute([
                "usr_id" => $user_id
            ]);
            $registers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($registers);
        } catch (PDOException $e) {
            echo 'Error en la conexión ' . $e->getMessage();
            exit();
        }
    } else {
        echo json_encode(["error" => "No param"]);
    }
} else {
    echo json_encode(["error" => "Bad Request"]);
}


?>