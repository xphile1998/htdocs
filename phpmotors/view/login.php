<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page | PHP Motors</title>
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
            <h1 class="account-heading">Sign in</h1>

            <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
            ?>

            <form class="login_form" method="post" action="/phpmotors/accounts/">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="clientEmail" <?php 
                if (isset($clientEmail)) {
                    echo "value='$clientEmail'";
                }
                ?> required>

                <label for="password">Password</label>
                <span>Passwords must at least 8 characters and contain at least 1 number, 1 captial letter, and 1 special character.</span>
                <input type="text" id="password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
                <br />
                <input type="submit" name="submit" value="Sign-in">
                <input type="hidden" name="action" value="login">
            </form>
            <br />
            <p><a href="/phpmotors/accounts/?action=deliverRegisterView" id="toreg">Not a member yet?</a></p>
        </main>

        <hr>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>
    </div>

</body>

</html>