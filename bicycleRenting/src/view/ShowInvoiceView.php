<?php
session_start();
$userId = $_SESSION['userId'];
$profileUser = $_SESSION['profile'];
if (!isset($userId)) {
    header("Location: LogInView.php");
}

require_once("../logic/BookingBusinessLaw.php");
require_once("../logic/BicycleBusinessLaw.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['locatorToPay'])) {

        $bookingBusinessLaw = new BookingBusinessLaw();
        $bookingBusinessLaw->updateStateBooking($_POST['locatorToPay'], $_POST['state']);
        header("Location: ListBookingsView.php");

    } else if (isset($_POST['locatorToCancel'])) {
        $bookingBusinessLaw = new BookingBusinessLaw();
        $bicycleBusinessLaw = new BicycleBusinessLaw();
        $bookingBusinessLaw->updateStateBooking($_POST['locatorToCancel'], $_POST['state']);
        $bicycleBusinessLaw->updateToAvailableBicycle($_POST['locatorToCancel']);
        header("Location: ListBookingsView.php");

    } else if (isset($_POST['locatorToEliminate'])) {
        $bookingBusinessLaw = new BookingBusinessLaw();
        $bookingBusinessLaw->deleteBooking($_POST['locatorToEliminate']);
        header("Location: ListBookingsView.php");

    } else if (isset($_POST['locatorToFinished'])) {
        $bookingBusinessLaw = new BookingBusinessLaw();
        $bicycleBusinessLaw = new BicycleBusinessLaw();
        $bookingBusinessLaw->updateStateBooking($_POST['locatorToFinished'], $_POST['state']);
        $bicycleBusinessLaw->updateToAvailableBicycle($_POST['locatorToFinished']);
        header("Location: ListBookingsView.php");

    }

} else {
    $locator = $_GET['locator'];
    $bookingBusinessLaw = new BookingBusinessLaw();
    $invoiceData = $bookingBusinessLaw->findInvoiceBookingByLocator($locator);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="../../css/showInvoice.css">
    <link rel="stylesheet" href="../../images/bicycle.svg" type="image/x-icon">
    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M4 4.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1v.5h4.14l.386-1.158A.5.5 0 0 1 11 4h1a.5.5 0 0 1 0 1h-.64l-.311.935.807 1.29a3 3 0 1 1-.848.53l-.508-.812-2.076 3.322A.5.5 0 0 1 8 10.5H5.959a3 3 0 1 1-1.815-3.274L5 5.856V5h-.5a.5.5 0 0 1-.5-.5zm1.5 2.443-.508.814c.5.444.85 1.054.967 1.743h1.139L5.5 6.943zM8 9.057 9.598 6.5H6.402L8 9.057zM4.937 9.5a1.997 1.997 0 0 0-.487-.877l-.548.877h1.035zM3.603 8.092A2 2 0 1 0 4.937 10.5H3a.5.5 0 0 1-.424-.765l1.027-1.643zm7.947.53a2 2 0 1 0 .848-.53l1.026 1.643a.5.5 0 1 1-.848.53L11.55 8.623z'/%3E%3C/svg%3E">
</head>

<body>
    <div id="container">
        <div id="buttons">
            <div id="homeButton">
                <a href="MenuStartView.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path
                            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                    </svg>
                </a>
            </div>
            <div id="backButton">
                <a href="ListBookingsView.php"> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16'
                        fill='currentColor' class='bi bi-arrow-left' viewBox='0 0 16 16'>
                        <path fill-rule='evenodd'
                            d='M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z' />
                    </svg>
                </a>
            </div>
        </div>
        <div id="central">
            <div id="create">
                <div class="title">Invoice</div>
                <div class="group">
                    <label for="locator">Code locator:</label>
                    <div class="form-group">
                        <?php echo $invoiceData[0]['locator'] ?>
                    </div>
                </div>

                <div class="group">
                    <label for="user">User:</label>
                    <div class="form-group">
                        <?php echo $invoiceData[0]['id_user'] ?>
                    </div>
                </div>

                <div class="group">
                    <label for="name">Name client:</label>
                    <div class="form-group">
                        <?php echo $invoiceData[0]['name'] . " " . $invoiceData[0]['last_name'] ?>
                    </div>
                </div>

                <div class="group">
                    <label for="totalPrice">Total price:</label>
                    <div class="form-group">
                        <?php echo $invoiceData[0]['total_price'] ?>
                    </div>
                </div>

                <div class="group">
                    <label for="issueDate">Date has been done:</label>
                    <div class="form-group">
                        <?php echo $invoiceData[0]['reservation_date'] ?>
                    </div>
                </div>

                <div class="group">
                    <label for="modificationDate">Date last modification:</label>
                    <div class="form-group">
                        <?php echo $invoiceData[0]['last_modification_date'] ?>
                    </div>
                </div>

                <div class="group">
                    <label for="startDate">Start date:</label>
                    <div class="form-group">
                        <?php echo $invoiceData[0]['start_date'] ?>
                    </div>
                </div>

                <div class="group">
                    <label for="endDate">End date:</label>
                    <div class="form-group">
                        <?php echo $invoiceData[0]['end_date'] ?>
                    </div>
                </div>

                <div class="group">
                    <label for="bicycle">Bicycle 1:</label>
                    <div class="form-group">
                        <?php echo $invoiceData[0]['id_bicycle_1'] ?>
                    </div>
                </div>

                <div class="group">
                    <label for="bicycle">Bicycle 2:</label>
                    <div class="form-group">
                        <?php echo $invoiceData[0]['id_bicycle_2'] ?>
                    </div>
                </div>

                <div class="group">
                    <label for="bicycle">Bicycle 3:</label>
                    <div class="form-group">
                        <?php echo $invoiceData[0]['id_bicycle_3'] ?>
                    </div>
                </div>

                <div class="group">
                    <label for="bicycle">Bicycle 4:</label>
                    <div class="form-group">
                        <?php echo $invoiceData[0]['id_bicycle_4'] ?>
                    </div>
                </div>

                <div class="group">
                    <label for="bicycle">State booking</label>
                    <div class="form-group">
                        <?php echo $invoiceData[0]['state_reservation'] ?>
                    </div>
                </div>

                <?php

                if ($invoiceData[0]['state_reservation'] == "PENDING") {
                    echo "                
                    <div class='groupButton'>
                        <form id='payInvoice' method='POST' action='ShowInvoiceView.php'>
                            <input type='hidden' name='locatorToPay' value='" . $invoiceData[0]['locator'] . "'>
                            <input type='hidden' name='state' value='PAID'>
                            <input type='submit' name='actionUpdate' value='Pay'>
                        </form>
                    </div>
                    <div class='groupButton'>
                        <form id='cancelInvoice' method='POST' action='ShowInvoiceView.php'>
                            <input type='hidden' name='locatorToCancel' value='" . $invoiceData[0]['locator'] . "'>
                            <input type='hidden' name='state' value='CANCELLED'>
                            <input type='submit' name='actionUpdate' value='Cancel'>
                        </form>
                    </div>";
                }

                if ($profileUser == "Administrator") {
                    echo "
                    <div class='groupButton'>
                        <form id='eliminateInvoice' method='POST' action='ShowInvoiceView.php'>
                            <input type='hidden' name='locatorToEliminate' value='" . $invoiceData[0]['locator'] . "'>
                            <input type='submit' name='actionEliminate' value='Eliminate'>
                        </form>
                    </div>";
                }

                if ($invoiceData[0]['state_reservation'] != "FINISHED") {
                    echo "
                    <div class='groupButton'>
                        <form id='finishInvoice' method='POST' action='ShowInvoiceView.php'>
                            <input type='hidden' name='locatorToFinished' value='" . $invoiceData[0]['locator'] . "'>
                            <input type='hidden' name='state' value='FINISHED'>
                            <input type='submit' name='actionFinished' value='Finished'>
                        </form>
                    </div>";
                }

                ?>

            </div>
        </div>
    </div>
    <script src="../../js/PayButtonInvoice.js"></script>
    <script src="../../js/CancelButtonInvoice.js"></script>
    <script src="../../js/EliminateButtonInvoice.js"></script>
    <script src="../../js/FinishButtonInvoice.js"></script>
</body>

</html>