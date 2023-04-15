<?php
    //require ("../Negocio/usuarioReglasNegocio.php");

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $usuarioBL = new UsuarioReglasNegocio();
        $perfil =  $usuarioBL->verificar($_POST['user'],$_POST['key']);

        if($perfil==="Administrator") {
            session_start();
            $_SESSION['user'] = $_POST['user'];
            header("Location: menuStartAdminView.php");
        } elseif($perfil==="Worker") {
            session_start();
            $_SESSION['user'] = $_POST['user'];
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
                    <input id = "password" name = "password" type = "password" placeholder="Password">
                    <input id = "button" type = "submit" value="Submit">
                </form> 
                <?php
                    if(isset($error)) {
                        echo $profile;
                    }
                ?>               
            </div>
        </div>
    </div>
</body>
</html>