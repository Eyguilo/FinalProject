<?php

ini_set('display_errors', 'On');
ini_set('html_errors', 1);

class LogInDataAccess
{

    function __construct()
    {
    }

    function addUser($userId, $name, $lastName, $key, $profileUser)
    {

        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');
        $query = mysqli_prepare($connection, "INSERT INTO T_Users VALUES (?,?,?,?,?);");
        $hashKey = password_hash($key, PASSWORD_DEFAULT);
        $query->bind_param("sssss", $userId, $name, $lastName, $hashKey, $profileUser);
        $result = $query->execute();

        return $result;
    }

    function verifyUser($userId, $key)
    {
        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');
        $query = mysqli_prepare($connection, "SELECT u.id_user, u.key_user, u.profile_user FROM T_Users u WHERE u.id_user = (?);");
        $sanitizedUser = mysqli_real_escape_string($connection, $userId);
        $query->bind_param("s", $sanitizedUser);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows == 0) {
            return 'No profile found with that username.';
        }

        if ($result->num_rows > 1) {
            return 'More than one profile with that username, ask for help to administrator.';
        }

        $resultArray = $result->fetch_assoc();
        $key_user = $resultArray['key_user'];

        if (password_verify($key, $key_user)) {
            return $resultArray['profile_user'];
        } else {
            return 'Username or password incorrects.';
        }
    }
}