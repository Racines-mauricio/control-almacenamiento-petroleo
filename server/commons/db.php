<?php

$host = 'localhost';
$port = '5432';
$user = 'postgres';
<<<<<<< HEAD
$pass = '1004612579';
=======
$pass = '1234';
>>>>>>> d4125dd1d86308b462a3d10b212578cc9adefe2b
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