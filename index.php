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
    <main>
        <h1>Registro de ingresos <?php echo $_SESSION['user_name']; ?></h1>
        <form action="server/register/create.php" method="post" class="my-form">
            <label for="due_date" class="field">
                <span>Release date:</span>
                <input type="date" name="due_date" placeholder="due_date" id="due_date" />
            </label>
            <label for="quantity" class="field">
                <span>Quantity: </span>
                <input type="text" name="quantity" placeholder="quantity" id="quantity" />
            </label>

            <input type="hidden" name="user_id" placeholder="user_id" id="user_id" required
                value="<?php echo $_SESSION['user_id']; ?>" />
            <label for="id_fuel" class="field">
                <span>
                    <span class="req-field">*</span>
                    Fuel:
                </span>

                <select id="fuel_list" name="id_fuel" class="form-control form-control-sm" required>

                </select>
            </label>
            <button type="submit">Enviar</button>
        </form>
        <ul id="register-list"></ul>
    </main>
</body>

</html>