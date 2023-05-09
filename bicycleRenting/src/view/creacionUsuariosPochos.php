<?php
    require("../infraestructure/logInDataAccess.php");

    function test_alta_usuario() {
        $u = new LogInDataAccess();
        return $u->addUser('JMGL000', 'Jaume', 'Pizà', '1234', 'Worker');        
    }

    function test_verificar_usuario_encontrado() {
        $perfil_esperado = 'Worker';
        $u = new LogInDataAccess();
        $perfil = $u->verifyUser('JMGL000','1234');
        return $perfil === $perfil_esperado;
    }
    var_dump(test_alta_usuario());
    var_dump(test_verificar_usuario_encontrado());
