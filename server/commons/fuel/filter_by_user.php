<?php
require '../commons/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id_user'])) {
        try {
            $user_id = $_GET['id_user'];
            $q = "SELECT * FROM register_fuel.usr WHERE id_user = :usr_id";
            $stmt = $db->prepare($q);
            $stmt->execute([
                "usr_id" => $user_id
            ]);
            $type_fuel = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($type_fuel);
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