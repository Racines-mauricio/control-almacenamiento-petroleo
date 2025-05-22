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
<header>
    <h1>Fuel - Nariño</h1>
    <a href="/control-almacenamiento-petroleo/pages/menu.php">
        <button id="regresar" class="left-align">Regresar</button>
    </a>
</header>

<body>
    <main>
        <br>
        <h1>Registro de ingresos</h1>
        <br>
        <form id="register-form" class="my-form">
            <input type="hidden" id="register-id" name="id" value="" />
            <label for="due_date" class="field">
                <span>Release date:</span>
                <input type="date" name="due_date" id="due_date" required />
            </label>
            <label for="quantity_barrel" class="field">
                <span>Quantity: </span>
                <input type="number" name="quantity_barrel" id="quantity_barrel" required />
            </label>

            <input type="hidden" name="user_id" id="user_id" required value="<?php echo $_SESSION['user_id']; ?>" />

            <label for="fuel_list" class="field">
                <span><span class="req-field">*</span> Fuel:</span>
                <select id="fuel_list" name="id_fuel" required></select>
            </label>
            <button type="submit" id="submit-btn">Enviar</button>
            <button type="button" id="cancel-edit-btn" style="display:none;">Cancelar</button>
        </form>

        <ul id="register-list"></ul>
    </main>
</body>

</html>
