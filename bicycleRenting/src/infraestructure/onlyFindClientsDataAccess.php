<?php

header("access-control-allow-origin: *");
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

if (isset($_REQUEST['name'])) {
    $source = $_REQUEST['name'];
    $nameParts = explode(" ", $source);
    $name = $nameParts[0];
    if($nameParts[1] !== ""){
        $lastName = $nameParts[1];
    } else{
        $lastName = "";
    }
}

$connection = mysqli_connect('localhost', 'root', '1234');
if (mysqli_connect_errno()) {
    echo "Error connecting to MySQL: " . mysqli_connect_error();
}

mysqli_select_db($connection, 'db_bicycle_renting');
$query = mysqli_prepare($connection, "SELECT c.id_client, CONCAT(c.name, ' ', c.last_name) as complete_name FROM T_Clients c WHERE c.name LIKE ? AND c.last_name LIKE ?;");
$nameParam = "%" . $name . "%";
$lastNameParam = "%" . $lastName . "%";
$query->bind_param("ss", $nameParam, $lastNameParam);
$query->execute();
$result = $query->get_result();

$clientsName = array();
while ($myrow = $result->fetch_assoc()) {
    array_push($clientsName, $myrow);
}

echo json_encode($clientsName);