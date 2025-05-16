<?php

$host = 'localhost';
$port = '5433';
$user = 'postgres';
<<<<<<< HEAD
$pass = '1234';
=======
$pass = '1004612579';
>>>>>>> 58876d9be71e26fd479cd4d5ac02badafb1113df
$db_name = 'register_fuel';



try {
    $db = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db_name",
        $user,
        $pass
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error en la conexión ' . $e->getMessage();
    exit();
}

?>