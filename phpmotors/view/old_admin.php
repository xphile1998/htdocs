<?php
$_SESSION['loggedin'] = TRUE;
if (!$_SESSION['loggedin']) {
    header('Location: /index.php');
}
?><!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Admin | PHP Motors</title>
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
            <h1>
                <?php
                echo $_SESSION['clientData']['clientFirstname'] .' '. $_SESSION['clientData']['clientLastName'];
                ?>
            </h1>

            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>

            <h2>You are logged in.</h2>
            <ul>
                <li><?php echo "First Name: ".$_SESSION['clientData']['clientFirstname']; ?></li>
                <li><?php echo "Last Name: ".$_SESSION['clientData']['clientLastname'] ?></li>
                <li><?php echo "Email: ".$_SESSION['clientData']['clientEmail']; ?></li>
            </ul>

            <h3>Use this link to update your account information:</h3>
            <a href="/accounts/index.php/?action=updateInfo">Update Account Information</a>

            <?php
            if (intval($_SESSION['clientData']['clientLevel']) > 1) {
                echo "<h2>Inventory Management</h2>";
                echo "<h3>Use this link to manage vehicle inventory</h3>";
                echo "<a href='/vehicles/'>Vehicle Management</a>";
            }
            ?>

        </main>

        <hr>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div>
</body>

</html>