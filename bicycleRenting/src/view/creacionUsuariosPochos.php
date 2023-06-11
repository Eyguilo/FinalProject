<?php
    require("../infraestructure/UserDataAccess.php");

    function test_alta_usuario() {
        $u = new UserDataAccess();
        return $u->createUser('JMGL000', 'Jaume', 'Piza', '1234', 'Administrator');        
    }

    function test_verificar_usuario_encontrado() {
        $perfil_esperado = 'Administrator';
        $u = new UserDataAccess();
        $perfil = $u->verifyUser('JMGL000','1234');
        return $perfil === $perfil_esperado;
    }
    var_dump(test_alta_usuario());
    var_dump(test_verificar_usuario_encontrado());
