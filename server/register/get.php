<?php
require '../commons/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM register_fuel.register WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $register = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($register);
}
?>
