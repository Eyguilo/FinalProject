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
    $filterData = array($_POST['brand'], $_POST['model'], $_POST['size'], $_POST['available']);
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
    <link rel="stylesheet" href="../../css/createBooking.css">
</head>

<body>
    <div id="container">
        <div id="back-button">
            <a href="menuStartView.php">Home</a>
        </div>
        <div id="centralBooking">
            <div id="create">
                <div class="title">Create Booking</div>
                <form method="POST" action="createBookingView.php">
                    <div class="form-group">
                        <label>Worker:
                            <?php echo $userId; ?>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="clientName">Client:</label>
                        <input type="text" id="clientName" name="clientName" autocomplete="off"
                            placeholder="ex. Jaume Aguiló"><br><br>
                        <select id="clientList" name="clientList">
                            <option value="" selected>Select a client</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="startDate">Start date:</label>
                        <input type="date" id="startDate" name="startDate">
                    </div>
                    <div class="form-group">
                        <label for="endDate">End date:</label>
                        <input type="date" id="endDate" name="endDate">
                    </div>
                    <div class="form-group">
                        <label for="startTime">Start time:</label>
                        <input type="time" id="startTime" name="startTime">
                    </div>
                    <div class="form-group">
                        <label for="endTime">End time:</label>
                        <input type="time" id="endTime" name="endTime">
                    </div>
                    <div class="form-group-2">
                        <label for="bicycle1">Bicycle 1:</label>
                        <input type="text" id="bicycle1" name="bicycle1" autocomplete="off"
                            placeholder="1">
                    </div>

                    <div class="form-group-2">
                        <label for="bicycle2">Bicycle 2:</label>
                        <input type="text" id="bicycle2" name="bicycle2" autocomplete="off"
                            placeholder="2">
                    </div>

                    <div class="form-group-2">
                        <label for="bicycle3">Bicycle 3:</label>
                        <input type="text" id="bicycle3" name="bicycle3" autocomplete="off"
                            placeholder="3">
                    </div>

                    <div class="form-group-2">
                        <label for="bicycle4">Bicycle 4:</label>
                        <input type="text" id="bicycle4" name="bicycle4" autocomplete="off"
                            placeholder="4">
                    </div>
                    <input type="submit" value="Create booking">
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../../js/findClients.js"></script>
        <div id="centralList">
            <div id="create">
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
                                            $resultSizes = $listBicyclesBusinessLaw->findSizes();
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
                                            echo "<option value='' selected>Select available</option>";
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

                                echo "
                                    <tr>
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
    </div>
</body>

</html>