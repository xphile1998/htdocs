<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management</title>
    <link rel = "stylesheet" media="screen" href = "/phpmotors/css/normalize.css">
    <link rel = "stylesheet" media="screen" href = "/phpmotors/css/main.css">
    <link rel = "stylesheet" media="screen" href = "/phpmotors/css/medium.css">
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
            <li><a href="/phpmotors/vehicles/index.php?action=addClassification">Add a Classification</a></li>
            <li><a href="/phpmotors/vehicles/index.php?action=addVehicle">Add a Vehicle</a></li>
        </ol>
        
    </main>
    
    <hr>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>

</div>
</body>
</html>