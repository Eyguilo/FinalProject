<?php
session_start();
$userId = $_SESSION['userId'];
if (!isset($userId)) {
    header("Location: logInView.php");
}

$locator = $_GET['locator'];

require_once("../logic/createBookingBusinessLaw.php");
$createBookingBusinessLaw = new CreateBookingBusinessLaw();
$invoiceData = $createBookingBusinessLaw->findInvoiceBookingByLocator($locator);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $createClientBusinessLaw = new CreateClientBusinessLaw();
    $clientData = $createClientBusinessLaw->createClient(
        $_POST['clientName'],
        $_POST['clientLastName'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['address'],
        $_POST['postalCode']
    );

    header("Location: menuStartView.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="../../css/findInvoice.css">
</head>

<body>
    <div id="container">
        <div id="buttons">
            <div id="homeButton">
                <a href="menuStartView.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                        <path
                            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                        <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                    </svg>
                </a>
            </div>
            <div id="backButton">
                <a href="listBookingsView.php"> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16'
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
                    <form method="POST" action="createClientView.php">
                        <input type="submit" value="Pay">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>