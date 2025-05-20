<?php
require '../commons/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        trim($_POST['type']) != '' &&
        trim($_POST['user_id']) != ''
    ) {
        try {
            $q = "INSERT INTO register_fuel.fuel(type, user_id)";
            $q = $q . " VALUES (:type, :user_id);";
            $stmt = $db->prepare($q);
            $stmt->execute([
                "type" => $_POST["type"],
                "user_id" => $_POST["user_id"]
            ]);

            echo json_encode(
                [
                    'success' => true,
                    'message' => 'Registro de combustible creado correctamente'
                ]
            );

        } catch (PDOException $e) {
            echo json_encode(
                [
                    'success' => false,
                    'message' => 'Error: '
                ]
            );
            exit();
        }
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'Error todos los campos son obligatorios '
            ]
        );
    }
}

?>