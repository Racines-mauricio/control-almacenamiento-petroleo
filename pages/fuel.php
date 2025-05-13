<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fuel</title>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/fuels.css'>
    <script src='../js/fuels.js'></script>
</head>

<body>
    <h2>Tipo de combustible </h2>
    <form id="fuel-form">
        <label for="type" class="field">
            <span>
                <span class="req-field">*</span>
                Tipo:
            </span>
            <input type="text" name="type" placeholder="type" id="type" required />
        </label>
        <input type="hidden" name="user_id" placeholder="user_id" id="user_id" required
            value="<?php echo $_SESSION['user_id']; ?>" />
        <button type="submit">Guardar</button>
    </form>
    <div id="message"></div>
    <hr>
    <h2>Listado de combustibles</h2>
    <table>
        <thead>
            <th>Id</th>
            <th>Tipo</th>
            <th>Fecha creado</th>
        </thead>
        <tbody id="fuel-list">

        </tbody>
    </table>

</body>

</html>