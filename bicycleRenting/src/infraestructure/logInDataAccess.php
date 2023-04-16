<?php

    ini_set('display_errors', 'On');
    ini_set('html_errors', 1);

    class LogInDataAccess {	

        function __construct() {
        }

        function addUser($name, $lastName, $username, $key, $profile) {

            $connection = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno()) {
                echo "Error connecting to MySQL: ". mysqli_connect_error();
            }
            
            mysqli_select_db($connection, 'db_bicycle_renting');
            $query = mysqli_prepare($connection, "INSERT INTO T_Users VALUES (?,?,?,?,?);");
            $hashKey = password_hash($key, PASSWORD_DEFAULT);
            $query->bind_param("sssss", $name, $lastName, $username, $hashKey, $profile);
            $result = $query->execute();
            
            return $result;
        }

        function verifyUser($username, $key) {
            $conexion = mysqli_connect('localhost','root','1234');
            if (mysqli_connect_errno()) {
                echo "Error connecting to MySQL: ". mysqli_connect_error();
            }
            
            mysqli_select_db($conexion, 'db_bicycle_renting');
            $query = mysqli_prepare($conexion, "SELECT username, key_user, profile_user FROM T_Users WHERE username = (?);");
            $sanitized_user = mysqli_real_escape_string($conexion, $username);       
            $query->bind_param("s", $sanitized_user);
            $query->execute();
            $result = $query->get_result();

            if ($result->num_rows==0) {
                return 'No profile found with that username.';
            }

            if ($result->num_rows>1) {
                return 'More than one profile with that username, ask for help to Administrator.';
            }

            $resultArray = $result->fetch_assoc();
            $key_user = $resultArray['key_user'];

            if (password_verify($key, $key_user)) {
                return $resultArray['profile_user'];
            } else {
                return 'NOT_FOUND3';
            }
        }
    }


