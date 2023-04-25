<?php
session_start();
$userId = $_SESSION['userId'];
if (!isset($userId)) {
    header("Location: logInView.php");
}

require_once("../logic/createClientBusinessLaw.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $createClientBusinessLaw = new CreateClientBusinessLaw();
    $clientData = $createClientBusinessLaw->createClient(
        $_POST['clientName'],
        $_POST['clientLastName'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['address'],
    );

    header("Location: menuStartAdminView.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create booking</title>
    <link rel="stylesheet" href="../../css/listBicycles.css">
</head>

<body>
    <div id="container">
        <div id="central">
            <div id="create">
                <div class="title">List of bicycles</div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>
                                    <label for="brand">Brand:</label>
                                    <select id="brand" name="brand">
                                        <?php
                                        echo '<option value="1">Brand 1</option>';
                                        echo '<option value="2">Brand 2</option>';
                                        echo '<option value="3">Brand 3</option>';
                                        ?>
                                    </select>
                                </th>
                                <th>
                                    <label for="brand">Brand:</label>
                                    <select id="brand" name="brand">
                                        <?php
                                        echo '<option value="1">Brand 1</option>';
                                        echo '<option value="2">Brand 2</option>';
                                        echo '<option value="3">Brand 3</option>';
                                        ?>
                                    </select>
                                </th>
                                <th>
                                    <label for="brand">Brand:</label>
                                    <select id="brand" name="brand">
                                        <?php
                                        echo '<option value="1">Brand 1</option>';
                                        echo '<option value="2">Brand 2</option>';
                                        echo '<option value="3">Brand 3</option>';
                                        ?>
                                    </select>
                                </th>
                                <th>
                                    <label for="brand">Brand:</label>
                                    <select id="brand" name="brand">
                                        <?php
                                        echo '<option value="1">Brand 1</option>';
                                        echo '<option value="2">Brand 2</option>';
                                        echo '<option value="3">Brand 3</option>';
                                        ?>
                                    </select>
                                </th>
                                <th>
                                    <label for="brand">Brand:</label>
                                    <select id="brand" name="brand">
                                        <?php
                                        echo '<option value="1">Brand 1</option>';
                                        echo '<option value="2">Brand 2</option>';
                                        echo '<option value="3">Brand 3</option>';
                                        ?>
                                    </select>
                                </th>
                                <th>
                                    <label for="brand">Brand:</label>
                                    <select id="brand" name="brand">
                                        <?php
                                        echo '<option value="1">Brand 1</option>';
                                        echo '<option value="2">Brand 2</option>';
                                        echo '<option value="3">Brand 3</option>';
                                        ?>
                                    </select>
                                </th>
                                <th>
                                    <label for="brand">Brand:</label>
                                    <select id="brand" name="brand">
                                        <?php
                                        echo '<option value="1">Brand 1</option>';
                                        echo '<option value="2">Brand 2</option>';
                                        echo '<option value="3">Brand 3</option>';
                                        ?>
                                    </select>
                                </th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Fila 1, Columna 1</td>
                                <td>Fila 1, Columna 2</td>
                                <td>Fila 1, Columna 3</td>
                                <td>Fila 1, Columna 4</td>
                                <td>Fila 1, Columna 5</td>
                                <td>Fila 1, Columna 6</td>
                                <td>Fila 1, Columna 7</td>
                                <td>Fila 1, Columna 8</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form method="POST" action="createBookingView.php">
                    <div class="form-group">
                        <label for="client">Client:</label>
                        <select id="client" name="client">
                            <?php
                            // Aquí podrías realizar una consulta a la base de datos
                            // para obtener los clientes y mostrarlos en el dropdown
                            echo '<option value="1">Cliente 1</option>';
                            echo '<option value="2">Cliente 2</option>';
                            echo '<option value="3">Cliente 3</option>';
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="worker">Worker:</label>
                        <select id="worker" name="worker">
                            <?php
                            // Aquí podrías realizar una consulta a la base de datos
                            // para obtener los trabajadores y mostrarlos en el dropdown
                            echo '<option value="1">Worker 1</option>';
                            echo '<option value="2">Worker 2</option>';
                            echo '<option value="3">Worker 3</option>';
                            ?>
                        </select>
                    </div>
                    <input type="submit" value="Create booking">
                </form>
            </div>
        </div>
    </div>
</body>

</html>