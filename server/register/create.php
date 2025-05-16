<?php
require '../commons/db.php';

var_dump($_SERVER['REQUEST_METHOD']);
var_dump($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        trim($_POST['due_date']) != '' &&
        trim($_POST['user_id']) != '' &&
        trim($_POST['fuel_id']) != ''
    ) {

        try {
            $q = "INSERT INTO register_fue.register(due_date, quantity_barrel, id_fuel, id_user)";
            $q = $q . " VALUES (:due_date, :quantity_barrel, :id_fuel, :id_user );";
            $stmt = $db->prepare($q);
            $stmt->execute([
                "due_date" => $_POST["due_date"],
                "quantity_barrel" => $_POST["quantity_barrel"],
                "id_fuel" => $_POST["id_fuel"],
                "id_user" => $_POST["id_user"]
            ]);
        } catch (PDOException $e) {
            echo 'Error en la conexión ' . $e->getMessage();
            exit();
        }

        header("Location: /control-almacenamiento-petroleo/");

    } else {
        echo 'Nooooooooooo pasa';
    }
}

?>