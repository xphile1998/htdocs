<?php 
// Build a Select List for classificationName for adding a vehicle
$selectList = "<select id='classificationId' name='classificationId'>";
    foreach ($classificationsList as $selectItem) {
        $selectList .= "<option value='$selectItem[classificationId]'";
        if (isset($classificationId)) {
            if($selectItem['classificationId'] === $classificationId) {
                $selectList .= ' selected ';
            }
        }
        $selectList .= ">$selectItem[classificationName]</option>";
    }
$selectList .= "</select>";
?><!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Vehicle</title>
    <link rel="stylesheet" media="screen" href="/phpmotors/css/normalize.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/main.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/medium.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <div id="content_box">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>

        <nav class="navigation">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>
        </nav>

        <main>
            <h1>Add a Vehicle</h1>

            <?php
                if (isset($message)) {
                    echo ($message);
                    $message = "";
                }
            ?>

            <form id="addVehicle" action="/phpmotors/vehicles/index.php" method="post">
                <label for="invMake">Enter the Make (manufacturer)</label>
                <input type="text" id="invMake" name="invMake" size="30" <?php 
                    if (isset($invMake)) {
                        echo "value='$invMake'";
                    }
                ?> required>
                <br>

                <label for="invModel">Enter in the Model name</label>
                <input type="text" id="invModel" name="invModel" size="30" <?php 
                    if (isset($invModel)) {
                        echo "value='$invModel'";
                    }
                ?> required>
                <br>

                <label for="invDescription">Enter in a Description of the vehicle</label>
                <textarea rows="5" cols="30" id="invDescription" name="invDescription" <?php 
                    if (isset($invDescription)) {
                        echo "value='$invDescription'";
                    }
                ?> required></textarea>
                <br>

                <label for="invPrice">Enter in the Price of the vehicle</label>
                <input type="number" id="invPrice" name="invPrice" <?php 
                    if (isset($invPrice)) {
                        echo "value='$invPrice'";
                    }
                ?> required>
                <br>

                <label for="invStock">Enter in the number in Stock</label>
                <input type="number" id="invStock" name="invStock" <?php 
                    if (isset($invStock)) {
                        echo "value='$invStock'";
                    }
                ?> required>
                <br>

                <label for="invColor">Enter in the Color</label>
                <input type="text" id="invColor" name="invColor" size="30" <?php 
                    if (isset($invColor)) {
                        echo "value='$invColor'";
                    }
                ?> required>
                <br>

                <label for="classificationId">Enter in the Classisfication</label>
                <?php 
                    if (!empty($selectList)) {
                        echo $selectList; 
                    }
                ?>
                <br>
                <br>
                
                <input type="submit" name="submit" id="addbtn" value="Add Vehicle">
                <input type="hidden" name="action" value="addVehicle">
            </form>
        </main>

        <hr>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div>
</body>

</html>