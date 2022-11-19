<?php
if (!$_SESSION['loggedin']) {
    header('Location: /phpmotors/');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Update</title>
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
            <h1>Update Your Account Data</h1>

            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                // unset($_SESSION['message']);
            }
            ?>

            <form method="post" action="/phpmotors/accounts/">
                <label for="clientFirstname">First Name</label>
                <input type="text" name="clientFirstname" id="clientFirstname" required value="<?php
                                                                                                if (isset($clientFirstname)) {
                                                                                                    echo $clientFirstname;
                                                                                                } else if (isset($_SESSION['clientData']['clientFirstname'])) {
                                                                                                    echo $_SESSION['clientData']['clientFirstname'];
                                                                                                }
                                                                                                ?>"><br>
                <label for="clientLastname">Last Name</label>
                <input type="text" name="clientLastname" id="clientLastname" required value="<?php
                                                                                                if (isset($clientLastname)) {
                                                                                                    echo $clientLastname;
                                                                                                } else if (isset($_SESSION['clientData']['clientLastname'])) {
                                                                                                    echo $_SESSION['clientData']['clientLastname'];
                                                                                                }
                                                                                                ?>"><br>
                <label for="clientEmail">Email</label>
                <input type="email" name="clientEmail" id="clientEmail" required value="<?php
                                                                                        if (isset($clientEmail)) {
                                                                                            echo $clientEmail;
                                                                                        } else if (isset($_SESSION['clientData']['clientEmail'])) {
                                                                                            echo $_SESSION['clientData']['clientEmail'];
                                                                                        }
                                                                                        ?>"><br>
                <input type="submit" value="Update Info">
                <input type="hidden" name="action" value="updateAccount">
                <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">
            </form>

            <h2>Update Password</h2>
            <?php
            // if (isset($_SESSION['message'])) {
            //     echo $_SESSION['message'];
            // }
            // ?>
            <form method="post" action="/phpmotors/accounts/">
                <span>Passwords must be at least 8 characters long and contain at least 1 number, 1 capital letter, and 1 special character</span>
                <p class="message">Note: Your original password will be changed.</p>
                <label for="clientPassword">Password</label>
                <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br>
                <input type="submit" value="Update Password">
                <input type="hidden" name="action" value="updatePassword">
                <input type="hidden" name="clientId" value="<?php $_SESSION['clientData']['clientId']; ?>">
            </form>

        </main>

        <hr>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div>
</body>

</html>