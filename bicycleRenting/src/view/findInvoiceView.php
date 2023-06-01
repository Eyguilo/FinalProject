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
        <div id="central">
            <div id="create">
                <div id="back-button">
                    <a href="menuStartView.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                            <path
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                        </svg>
                    </a>
                </div>
                <div class="title">Create client</div>
                <form method="POST" action="createClientView.php">
                    <div class="form-group">
                        <label for="clientName">Client name:</label>
                        <input type="text" id="clientName" name="clientName" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="clientLastName">Last name:</label>
                        <input type="text" id="clientLastName" name="clientLastName" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="example@example.com" required
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="tel" id="phone" name="phone" pattern="(\+[0-9]{2,3} )?[0-9]{9-12}"
                            placeholder="(+34) 695652874" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="postalCode">Postal code:</label>
                        <input type="text" id="postalCode" name="postalCode" autocomplete="off" pattern="[0-9]{5}"
                            placeholder="07180" required autocomplete="off">
                    </div>
                    <input type="submit" value="Create client">
                </form>
            </div>
        </div>
    </div>
</body>

</html>