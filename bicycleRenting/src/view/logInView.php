<?php
    require ("../logic/logInBusinessLaw.php");

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $logInBusinessLaw = new LogInBusinessLaw();
        $profile_user =  $logInBusinessLaw->verifyUser($_POST['username'],$_POST['key_user']);

        var_dump($_POST['username']);
        var_dump($_POST['key_user']);
        if($profile_user==="Administrator") {
            session_start();
            $_SESSION['username'] = $_POST['username'];
            header("Location: menuStartAdminView.php");
        } elseif($profile_user==="Worker") {
            session_start();
            $_SESSION['username'] = $_POST['username'];
            header("Location: menuStartWorkerView.php");
        } else{
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
                <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input id="username" name = "username" type = "text" placeholder="Username">
                    <input id = "key_user" name = "key_user" type = "password" placeholder="Password">
                    <input id = "button" type = "submit" value="Submit">
                </form> 
                <?php
                    if(isset($error)) {
                        echo $profile_user;
                    }
                ?>               
            </div>
        </div>
    </div>
</body>
</html>