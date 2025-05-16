<?php
require '../commons/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id_user'])) {
        try {
            $id_user = $_GET['id_user'];
            $q = "SELECT * FROM register_fuel.register WHERE id_user = :usr_id";
            $stmt = $db->prepare($q);
            $stmt->execute([
                "usr_id" => $id_user
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