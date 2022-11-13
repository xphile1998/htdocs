<?php
// if (!$_SESSION['loggedin']) {
//     header('Location: /phpmotors/');
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
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
            <h1><?php echo $_SESSION['clientData']['clientFirstname'].' '.$_SESSION['clientData']['clientLastname']; ?></h1>

            <ul class="client_data">
                <li>First Name: <?php echo $_SESSION['clientData']['clientFirstname']; ?></li>
                <li>Last Name: <?php echo $_SESSION['clientData']['clientLastname']; ?></li>
                <li>Email Address: <?php echo $_SESSION['clientData']['clientEmail']; ?></li>
                <li>Client Level: <?php echo $_SESSION['clientData']['clientLevel']; ?></li>
            </ul>

            <?php 
            if ($_SESSION['clientData']['clientLevel'] > 1) { ?>
                <p><a href="../vehicles/">Vehicles Management</a></p>

            <?php } ?>
        </main>

        <hr>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div>
</body>

</html>