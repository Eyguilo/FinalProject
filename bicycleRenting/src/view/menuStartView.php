<?php
session_start();
$userId = $_SESSION['userId'];
if (!isset($userId)) {
    header("Location: LogInView.php");
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
    <link rel="stylesheet" href="../../images/bicycle.svg" type="image/x-icon">
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M4 4.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1v.5h4.14l.386-1.158A.5.5 0 0 1 11 4h1a.5.5 0 0 1 0 1h-.64l-.311.935.807 1.29a3 3 0 1 1-.848.53l-.508-.812-2.076 3.322A.5.5 0 0 1 8 10.5H5.959a3 3 0 1 1-1.815-3.274L5 5.856V5h-.5a.5.5 0 0 1-.5-.5zm1.5 2.443-.508.814c.5.444.85 1.054.967 1.743h1.139L5.5 6.943zM8 9.057 9.598 6.5H6.402L8 9.057zM4.937 9.5a1.997 1.997 0 0 0-.487-.877l-.548.877h1.035zM3.603 8.092A2 2 0 1 0 4.937 10.5H3a.5.5 0 0 1-.424-.765l1.027-1.643zm7.947.53a2 2 0 1 0 .848-.53l1.026 1.643a.5.5 0 1 1-.848.53L11.55 8.623z'/%3E%3C/svg%3E">
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
                <a id="logOut" href="LogOutView.php">
                    <div>Sign out</div>
                </a>
                <div class="title">Welcome
                    <?php echo $dataUser->getName(); ?>
                </div>
                <div class="links">
                    <a href="CreateBookingView.php">Create booking</a>
                    <a href="ListBookingsView.php">Bookings list</a>
                    <a href="CreateClientView.php">Create client</a> 
                    <a href="ListClientsView.php"> Clients list</a>                  
                    <a href="ListBicyclesView.php">Bicycles list</a>
                    <?php
                    if ($dataUser->getProfileUser() === "Administrator") {
                        echo "
                        <a href='CreateUserView.php'>Create user</a>
                        <a href='ListUsersView.php'>Users list</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>