<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Control almacenamiento petroleo</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/styles.css'>
    <script src='js/app.js'></script>
</head>

<body>
    <form action="server/user/logout.php" method="get">
        <button type="submit" class="delete-btn left-align">Cerrar sesión</button>
    </form>
    <a href="pages/user.php">
    <button type="submit" class="edit-btn right-align">Usuarios</button>
    </a>
    <br><br><br>
    <a href="pages/fuel.php">
    <button type="submit" class="edit-btn right-align">Combustibles</button>
    </a>
    <br><br><br>
    <main>
        <h1>Control de almacenamiento de combustible <?php echo $_SESSION['user_name']; ?></h1>
        <form action="server/task/create.php" method="post" class="my-form">
            <label for="due_date" class="field">
                <span>Release date:</span>
                <input type="date" name="due_date" placeholder="due_date" id="due_date" />
            </label>
            <label for="quantity" class="field">
                <span>Quantity: </span>
                <input type="text" name="quantity" placeholder="quantity" id="quantity" />
            </label>

            <input type="hidden" name="id_user" placeholder="id_user" id="id_user" required
                value="<?php echo $_SESSION['id_user']; ?>" />
            <label for="id_fuel" class="field">
                <span>
                    <span class="req-field">*</span>
                    Fuel:
                </span>

                <select id="fuel-list" name="id_fuel" class="form-control form-control-sm" required>

                </select>
            </label>
            <button type="submit">Enviar</button>
        </form>
        <ul id="register-list"></ul>
    </main>
</body>

</html>