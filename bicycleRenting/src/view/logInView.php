<?php
require("../logic/logInBusinessLaw.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $logInBusinessLaw = new LogInBusinessLaw();
    $profile_user = $logInBusinessLaw->verifyUser($_POST['userId'], $_POST['keyUser']);


    if ($profileUser === "Administrator") {
        session_start();
        $_SESSION['userId'] = $_POST['userId'];
        header("Location: menuStartAdminView.php");
    } elseif ($profileUser === "Worker") {
        session_start();
        $_SESSION['userId'] = $_POST['userId'];
        header("Location: menuStartWorkerView.php");
    } else {
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="../../css/logIn.css">
</head>

<body>
    <div id="container">
        <div id="central">
            <div id="start">
                <div class="title">Welcome</div>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input id="userId" name="userId" type="text" placeholder="Username">
                    <input id="keyUser" name="keyUser" type="password" placeholder="Password">
                    <input id="button" type="submit" value="Submit">
                </form>
                <?php
                if (isset($error)) {
                    echo $profileUser;
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>