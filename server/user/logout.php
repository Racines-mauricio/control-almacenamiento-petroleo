<?php

echo "Hasta pronto";
session_start();
session_destroy();
header('Location: /control-almacenamiento-petroleo/index.php');
exit;

?>