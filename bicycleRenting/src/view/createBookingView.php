<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

session_start();
$userId = $_SESSION['userId'];
if (!isset($userId)) {
    header("Location: logInView.php");
}

require_once("../logic/createBookingBusinessLaw.php");
$createBookingBusinessLaw = new CreateBookingBusinessLaw();

?>
<!DOCTYPE html>
<html lang="en">

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
                        <label>Worker:
                            <?php echo $userId; ?>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="clientName">Client:</label>
                        <input type="text" id="clientName" name="clientName">
                        <select id="clientList" name="clientList">
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
    <script src="../js/findClients.js"></script>
</body>

</html>