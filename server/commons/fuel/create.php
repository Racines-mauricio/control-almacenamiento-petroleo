<?php
require '../commons/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        trim($_POST['type']) != '' &&
        trim($_POST['id_user']) != ''
    ) {
        try {
            $q = "INSERT INTO register_fuel.fuel(type, id_user)";
            $q = $q . " VALUES (:type, :id_user);";
            $stmt = $db->prepare($q);
            $stmt->execute([
                "type" => $_POST["type"],
                "id_user" => $_POST["id_user"]
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