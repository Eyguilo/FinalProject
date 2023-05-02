<?php
session_start();
$userId = $_SESSION['userId'];
if (!isset($userId)) {
    header("Location: logInView.php");
}

require_once("../logic/listBicyclesBusinessLaw.php");
$listBicyclesBusinessLaw = new ListBicyclesBusinessLaw();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $listBicyclesBusinessLaw = new ListBicyclesBusinessLaw();
    $filterData = array($_POST['brand'], $_POST['model'], $_POST['size']);
    $filteredBicycles = $listBicyclesBusinessLaw->findBicycles($filterData);
} else {
    $falseFilter = "";
    $filteredBicycles = $listBicyclesBusinessLaw->findBicycles($falseFilter);
}



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
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <th>
                                        <label for="brand">Brand:</label>
                                        <select id="brand" name="brand" onchange="this.form.submit()">
                                            <?php
                                            $resultBrands = $listBicyclesBusinessLaw->findBrands();
                                            $valueBrand = 1;
                                            $selectedBrand = isset($_POST['brand']) ? $_POST['brand'] : "";
                                            echo "<option value='' selected>Select a brand</option>";
                                            foreach ($resultBrands as $brand) {
                                                $selected = ($selectedBrand == $valueBrand) ? "selected" : "";
                                                echo "<option value='" . $valueBrand . "' " . $selected . ">" . $brand[0] . "</option>";
                                                $valueBrand++;
                                            }
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                        <label for="model">Model:</label>
                                        <select id="model" name="model" onchange="this.form.submit()">
                                            <?php
                                            $resultModels = $listBicyclesBusinessLaw->findModels();
                                            $valueModel = 1;
                                            $selectedModel = isset($_POST['model']) ? $_POST['model'] : "";
                                            echo "<option value='' selected>Select a model</option>";
                                            foreach ($resultModels as $model) {
                                                $selected = ($selectedModel == $valueModel) ? "selected" : "";
                                                echo "<option value='" . $valueModel . "' " . $selected . ">" . $model[0] . "</option>";
                                                $valueModel++;
                                            }
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                        <label for="size">Size:</label>
                                        <select id="size" name="size" onchange="this.form.submit()">
                                            <?php
                                            $resultsizes = $listBicyclesBusinessLaw->findSizes();
                                            $valueSize = 1;
                                            $selectedSize = isset($_POST['size']) ? $_POST['size'] : "";
                                            echo "<option value='' selected>Select a size</option>";
                                            foreach ($resultsizes as $size) {
                                                $selected = ($selectedSize == $valueSize) ? "selected" : "";
                                                echo "<option value='" . $valueSize . "' " . $selected . ">" . $size[0] . "</option>";
                                                $valueSize++;
                                            }
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
                                </form>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($filteredBicycles as $bike) {

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