<?php
    require("../infraestructure/logInDataAccess.php");

    function test_alta_usuario() {
        $u = new LogInDataAccess();
        return $u->addUser('MAPI000', 'Marilén', 'Pizà', '1234', 'Administrator');        
    }

    function test_verificar_usuario_encontrado() {
        $perfil_esperado = 'Administrator';
        $u = new LogInDataAccess();
        $perfil = $u->verifyUser('MAPI000','1234');
        return $perfil === $perfil_esperado;
    }
    var_dump(test_alta_usuario());
    var_dump(test_verificar_usuario_encontrado());