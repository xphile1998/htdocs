<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Car Classification</title>
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
        <h1>Add a Car Classification</h1>

        <?php
            if (isset($message)) {
                echo ($message);
            }
        ?>

        <form id="addClassification" action="/phpmotors/vehicles/index.php" method="post">
            <label for="classificationName">New Classification Name</label>
            <input type="text" id="classificationName" name="classificationName">
            <br />
            <input type="submit" name="submit" id="addbtn" value="Add Classification">
            <input type="hidden" name="action" value="addClassification">
        </form>
    </main>
    
    <hr>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>

</div>
</body>
</html>