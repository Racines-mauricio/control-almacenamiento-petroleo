<?php

echo "Hasta pronto";
session_start();
session_destroy();
header('Location: /control-almacenamiento-petroleo/login.php');
exit;

?>