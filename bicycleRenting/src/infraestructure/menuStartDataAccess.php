<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

class MenuStartDataAccess
{
    function __construct()
    {
    }

    function obtainUserData($userId)
    {
        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');
        $query = mysqli_prepare($connection, "SELECT T_Users.id_user, T_Users.name, T_Users.profile_user FROM T_Users WHERE id_user = (?);");
        $sanitizedUserId = mysqli_real_escape_string($connection, $userId);
        $query->bind_param("s", $sanitizedUserId);
        $query->execute();
        $result = $query->get_result();

        return $result;
    }
}