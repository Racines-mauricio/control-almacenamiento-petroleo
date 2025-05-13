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
    <a href="pages/drivers.php">
    <button type="submit" class="edit-btn right-align">Conductores</button>
    </a>
    <br><br><br>
    <main>
        <h1>Control de almacenamiento de petroleo <?php echo $_SESSION['user_name']; ?></h1>
        <form action="server/task/create.php" method="post" class="my-form">
            <label for="due_date" class="field">
                <span>Release date:</span>
                <input type="date" name="due_date" placeholder="due_date" id="due_date" />
            </label>
            <label for="quantity" class="field">
                <span>Quantity: </span>
                <input type="text" name="quantity" placeholder="quantity" id="quantity" />
            </label>
            <label for="origin" class="field">
                <span>Origin: </span>
                <input type="text" name="origin" placeholder="origin" id="origin" />
            </label>
            
            <!--
            <label for="user_id" class="field">
                <span>
                    <span class="req-field">*</span>
                    User id:
                </span>
-->
            <input type="hidden" name="user_id" placeholder="user_id" id="user_id" required
                value="<?php echo $_SESSION['user_id']; ?>" />
            <!--</label>-->
            <label for="category_id" class="field">
                <span>
                    <span class="req-field">*</span>
                    Category:
                </span>
                <!--
                <input type="number" name="category_id" placeholder="category_id" id="category_id" required />
                -->
                <select id="category-list" name="category_id" class="form-control form-control-sm" required>

                </select>
            </label>
            <button type="submit">Enviar</button>
        </form>
        <ul id="task-list"></ul>
    </main>
</body>

</html>