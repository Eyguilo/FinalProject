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
    <title>Create client</title>
    <link rel="stylesheet" href="../../css/createClient.css">
</head>

<body>
    <div id="container">
        <div id="central">
            <div id="create">
                <div id="back-button">
                    <a href="menuStartView.php">Home</a>
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