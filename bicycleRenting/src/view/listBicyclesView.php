<?php
session_start();
$userId = $_SESSION['userId'];
if (!isset($userId)) {
    header("Location: logInView.php");
}

require_once("../logic/listBicyclesBusinessLaw.php");
$listBicyclesDataAccess = new ListBicyclesBusinessLaw();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List bicycles</title>
    <link rel="stylesheet" href="../../css/listBicycles.css">
</head>

<body>
    <div id="container">
        <div id="central">
            <div id="create">
                <div class="title">List of bicycles</div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>
                                    <label for="brand">Brand:</label>
                                    <select id="brand" name="brand">
                                        <?php
                                        $resultBrands = $listBicyclesDataAccess->findBrands();

                                        var_dump($resultBrands);
                                        foreach($resultBrands as $brand){
                                            
                                            echo "<option value='1'>". $brand[0]."</option>";
                                        }
                                        ?>
                                    </select>
                                </th>
                                <th>
                                    <label for="brand">Model:</label>
                                    <select id="brand" name="brand">
                                        <?php
                                        echo '<option value="1">Brand 1</option>';
                                        echo '<option value="2">Brand 2</option>';
                                        echo '<option value="3">Brand 3</option>';
                                        ?>
                                    </select>
                                </th>
                                <th>
                                    <label for="brand">Size:</label>
                                    <select id="brand" name="brand">
                                        <?php
                                        echo '<option value="1">Brand 1</option>';
                                        echo '<option value="2">Brand 2</option>';
                                        echo '<option value="3">Brand 3</option>';
                                        ?>
                                    </select>
                                </th>
                                <th>
                                    <label for="brand">Color</label>
                                </th>
                                <th>
                                    <label for="brand">Price / hour</label>
                                </th>
                                <th>
                                    <label for="brand">Available</label>
                                </th>
                                <th>
                                    <label for="brand">Reserve</label>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $resultBicyles = $listBicyclesDataAccess->findBicyles();

                            foreach ($resultBicyles as $bike) {

                                echo "
                                        <tr>
                                            <td>" . $bike['id'] . "</td>
                                            <td>" . $bike['brand'] . "</td>
                                            <td>" . $bike['model'] . "</td>
                                            <td>" . $bike['size'] . "</td>
                                            <td>" . $bike['color'] . "</td>
                                            <td>" . $bike['price'] . "</td>
                                            <td>" . $bike['available'] . "</td>
                                            <td>.WORKING ON IT.</td>
                                        </tr>";
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>