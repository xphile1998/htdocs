<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" media="screen" href="/phpmotors/css/normalize.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/main.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/medium.css">
</head>

<body>
    <div id="content_box">

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>

        <h1 class="account-heading">Sign in</h1>

        <main>
            <form method="post" class="login_form">
                <label for="email">Email Address</label>
                <input type="text" id="email" name="clientEmail">

                <label for="password">Password</label>
                <input type="password" id="password" name="clientPassword">
                <br />
                <input type="submit" value="Sign-in">
            </form>
            <br />
            <a href="/phpmotors/accounts/?action=deliveringRegisterView" id="toreg">Not a member yet?</a>
        </main>

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </div>

</body>

</html>