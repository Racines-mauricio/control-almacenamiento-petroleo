<?php

$host = 'localhost';
$port = '5432';
$user = 'postgres';
$pass = 'bshg1422';
$db_name = 'oil_barrel_control';



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