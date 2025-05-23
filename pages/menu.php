<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Menu principal</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/menu.css'>
</head>

<body>
    
    
    <header>
        <h1>Fuel - Nariño</h1>
        <form action="../server/user/logout.php" method="post" style="display: inline;">
            <button type="submit" class="delete-btn left-align" id="cerrar">Cerrar sesión</button>
        </form>

    </header>

    <main>
        <div class="card">
        <h1>Hola <?php echo $_SESSION['user_name']; ?>.👋🏼</h1>
        <h2>Bienvenido al sistema de registro de combustibles</h2>
        <p>Use el menú para registrar ingresos de combustible o consultar historial.</p>
        
        <a href="../index.php">
        <button type="submit" class="edit-btn right-align">Registrar ingresos / historial</button>

        <a href="../pages/fuel.php">
        <button type="submit" class="edit-btn right-align">Registrar combustible / historial</button>
        </a>

        

        
        </div>
</body>

</html>