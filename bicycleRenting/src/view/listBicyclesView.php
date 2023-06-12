<?php
session_start();
$userId = $_SESSION['userId'];
if (!isset($userId)) {
    header("Location: LogInView.php");
}

require_once("../logic/BicycleBusinessLaw.php");
$bicyclesBusinessLaw = new BicycleBusinessLaw();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $filterData = array($_POST['brand'], $_POST['model'], $_POST['size'], $_POST['available']);
    $filteredBicycles = $bicyclesBusinessLaw->findBicycles($filterData);
} else {
    $falseFilter = "";
    $filteredBicycles = $bicyclesBusinessLaw->findBicycles($falseFilter);
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
    <link rel="stylesheet" href="../../images/bicycle.svg" type="image/x-icon">
    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M4 4.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1v.5h4.14l.386-1.158A.5.5 0 0 1 11 4h1a.5.5 0 0 1 0 1h-.64l-.311.935.807 1.29a3 3 0 1 1-.848.53l-.508-.812-2.076 3.322A.5.5 0 0 1 8 10.5H5.959a3 3 0 1 1-1.815-3.274L5 5.856V5h-.5a.5.5 0 0 1-.5-.5zm1.5 2.443-.508.814c.5.444.85 1.054.967 1.743h1.139L5.5 6.943zM8 9.057 9.598 6.5H6.402L8 9.057zM4.937 9.5a1.997 1.997 0 0 0-.487-.877l-.548.877h1.035zM3.603 8.092A2 2 0 1 0 4.937 10.5H3a.5.5 0 0 1-.424-.765l1.027-1.643zm7.947.53a2 2 0 1 0 .848-.53l1.026 1.643a.5.5 0 1 1-.848.53L11.55 8.623z'/%3E%3C/svg%3E">
</head>

<body>
    <div id="container">
        <div id="back-button">
            <a href="MenuStartView.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path
                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                </svg>
            </a>
        </div>
        <div id="centralList">
            <div id="create">
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <label for="id">ID</label>
                                </th>
                                <form id="listBicyclesForm" method="POST"
                                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <th>
                                        <select id="brand" name="brand" onchange="this.form.submit()">
                                            <?php
                                            $resultBrands = $bicyclesBusinessLaw->findBrands();
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
                                        <select id="model" name="model" onchange="this.form.submit()">
                                            <?php
                                            $resultModels = $bicyclesBusinessLaw->findModels();
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
                                        <select id="size" name="size" onchange="this.form.submit()">
                                            <?php
                                            $resultSizes = $bicyclesBusinessLaw->findSizes();
                                            $valueSize = 1;
                                            $selectedSize = isset($_POST['size']) ? $_POST['size'] : "";
                                            echo "<option value='' selected>Select a size</option>";
                                            foreach ($resultSizes as $size) {
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
                                        <label for="available">Available</label>
                                        <select id="available" name="available" onchange="this.form.submit()">
                                            <?php
                                            $selectedAvailable = isset($_POST['available']) ? $_POST['available'] : "";
                                            echo "<option value='' selected>Select availability</option>";
                                            echo "<option value='1' " . ($selectedAvailable == '1' ? 'selected' : '') . ">Available</option>";
                                            echo "<option value='2' " . ($selectedAvailable == '2' ? 'selected' : '') . ">Not available</option>";
                                            ?>
                                        </select>
                                    </th>
                                </form>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($filteredBicycles as $bike) {
                                $availabilityClass = ($bike['available'] == 0) ? 'unavailable' : '';
                                echo "
                                    <tr class='" . $availabilityClass . "'>
                                        <td>" . $bike['id'] . "</td>
                                        <td>" . $bike['brand'] . "</td>
                                        <td>" . $bike['model'] . "</td>
                                        <td>" . $bike['size'] . "</td>
                                        <td>" . $bike['color'] . "</td>
                                        <td>" . $bike['price'] . "</td>
                                        <td>" . $bike['available'] . "</td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../../js/findClients.js"></script>
    </div>
</body>

</html>