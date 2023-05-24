<?php
session_start();
$userId = $_SESSION['userId'];
if (!isset($userId)) {
    header("Location: logInView.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../../css/menuStart.css">
</head>

<?php
require_once("../logic/menuStartBusinessLaw.php");

$menuStartAdminBusinessLaw = new MenuStartBusinessLaw();
$dataUser = $menuStartAdminBusinessLaw->obtainUserData($userId);
?>

<body>
    <div id="container">
        <div id="central">
            <div id="start">
                <div class="logAs">Log as:
                    <?php echo $dataUser->getUserId() . " - " . $dataUser->getProfileUser() ?>
                </div>
                <a id="logOut" href="logOutView.php">
                    <div>Sign out</div>
                </a>
                <div class="title">Welcome
                    <?php echo $dataUser->getName(); ?>
                </div>
                <div class="links">
                    <a href="createBookingView.php">Create booking</a>
                    <a href="createClientView.php">Create client</a>
                    <a href="">Booking list</a>
                    <a href="listBicyclesView.php">Bicycles</a>
                    <a href="">Bicycles routes</a>
                    <a href="">Our shops</a>
                    <?php
                    if ($dataUser->getProfileUser() === "Administrator") {
                        echo "<a href=''>Create user</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>