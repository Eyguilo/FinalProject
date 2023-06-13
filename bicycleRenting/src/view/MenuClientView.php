<?php

try {

    require_once("../logic/BookingBusinessLaw.php");
    $bookingBusinessLaw = new BookingBusinessLaw();

    $error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $locator = $_POST['locator'];
        $reservation = $bookingBusinessLaw->findInvoiceBookingByLocator($locator);

        if ($reservation) {

            header("Location: ShowInvoiceClientView.php?locator=$locator");
            exit();
        } else {
            $error = "The entered locator does not exist.";
        }

    }

} catch (Exception $e) {
    header("Location: ErrorView.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedal Haven</title>
    <link rel="stylesheet" href="../../css/menuClient.css">
    <link rel="stylesheet" href="../../images/bicycle.svg" type="image/x-icon">
    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M4 4.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1v.5h4.14l.386-1.158A.5.5 0 0 1 11 4h1a.5.5 0 0 1 0 1h-.64l-.311.935.807 1.29a3 3 0 1 1-.848.53l-.508-.812-2.076 3.322A.5.5 0 0 1 8 10.5H5.959a3 3 0 1 1-1.815-3.274L5 5.856V5h-.5a.5.5 0 0 1-.5-.5zm1.5 2.443-.508.814c.5.444.85 1.054.967 1.743h1.139L5.5 6.943zM8 9.057 9.598 6.5H6.402L8 9.057zM4.937 9.5a1.997 1.997 0 0 0-.487-.877l-.548.877h1.035zM3.603 8.092A2 2 0 1 0 4.937 10.5H3a.5.5 0 0 1-.424-.765l1.027-1.643zm7.947.53a2 2 0 1 0 .848-.53l1.026 1.643a.5.5 0 1 1-.848.53L11.55 8.623z'/%3E%3C/svg%3E">
</head>

<body>
    <div id="container">
        <div id="central">
            <div id="start">
                <a id="logOut" href="LogInView.php">
                    <div>Log in</div>
                </a>
                <div class="title">Welcome to Pedal Haven</div>
                <div class="links">
                    <div id="linkys"><a href="ListBicyclesClientView.php">Bicycles list</a></div>
                    <div id="linkys"><a href="CreateOwnClientView.php">Create client</a></div>                    
                    <div id="linkys"><a href="CreateBookingClientView.php">Create booking</a></div>
                    
                </div>
                <form id="menuClient" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="text" id="locator" name="locator" autocomplete="off" placeholder="aFDE34sD"
                        onchange="this.form.submit()">
                </form>
                <?php
                if ($error) {
                    echo "<div class='error'>" . $error . "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>