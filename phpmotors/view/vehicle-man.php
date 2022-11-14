<?php
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
    header('Location: /phpmotors/');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management</title>
    <link rel="stylesheet" media="screen" href="/phpmotors/css/normalize.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/main.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/medium.css">
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
            <h1>Vehicle Management</h1>

            <?php
            if (isset($message)) {
                echo ($message);
            }
            ?>

            <p class="welcome">Welcome to Vehicle Managment! What would you like to do today?</p>

            <ol class="vManageMenu">
                <li><a href="/phpmotors/vehicles/index.php?action=deliverAddClassification">Add a Classification</a></li>
                <li><a href="/phpmotors/vehicles/index.php?action=deliverAddVehicle">Add a Vehicle</a></li>
            </ol>

            <?php
            if (isset($message)) {
                echo $message;
            }
            if (isset($classificationList)) {
                echo '<h2>Vehicles By Classification</h2>';
                echo '<p class="message">Choose a classification to see those vehicles</p>';
                echo $classificationList;
            }
            ?>

            <noscript>
                <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
            </noscript>
            
            <table id="inventoryDisplay"></table>
        </main>

        <hr>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div>
    <script src="../js/inventory.js"></script>
</body>

</html>