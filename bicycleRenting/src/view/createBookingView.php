<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create booking</title>
    <link rel="stylesheet" href="../../css/createBooking.css">
</head>

<body>
    <div id="container">
        <div id="central">
            <div id="create">
                <div class="title">Create Booking</div>
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
                    <div class="form-group">
                        <label for="startDate">Start date:</label>
                        <input type="date" id="startDate" name="startDate">
                    </div>
                    <div class="form-group">
                        <label for="endDate">End date:</label>
                        <input type="date" id="endDate" name="endDate">
                    </div>
                    <div class="form-group">
                        <label for="startTime">Start time:</label>
                        <input type="time" id="startTime" name="startTime">
                    </div>
                    <div class="form-group">
                        <label for="endTime">End time:</label>
                        <input type="time" id="endTime" name="endTime">
                    </div>
                    <div class="form-group">
                        <label for="bicycle">Bicycle:</label>
                        <select id="bicycle" name="bicycle">
                            <?php
                            // Aquí podrías realizar una consulta a la base de datos
                            // para obtener las bicicletas y mostrarlas en el dropdown
                            echo '<option value="1">Bicycle 1</option>';
                            echo '<option value="2">Bicycle 2</option>';
                            echo '<option value="3">Bicycle 3</option>';
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