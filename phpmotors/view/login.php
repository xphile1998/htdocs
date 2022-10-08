<!DOCTYPE html>
<html lang="en-US">

<?php require $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/model/main-model.php'; ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel = "stylesheet" media="screen" href = "/phpmotors/css/normalize.css">
    <link rel = "stylesheet" media="screen" href = "/phpmotors/css/main.css">
    <link rel = "stylesheet" media="screen" href = "/phpmotors/css/medium.css">
</head>

<body>
<div id="content_box">
    <!-- PHP call to the HEADER snippet -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

    <!-- PHP call to the NAV snippet -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>

    <main>
        <h1>Sign in</h1>

        <form class="login_form">
            <!-- <div class="login_form"> -->
                <label for="email_adrs">Email Address</label>
                <input type="text" id="email_adrs" placeholder="username@email.com" name="clientEmail" required>
                
                <label for="psw">Password</label>
                <input type="password" id="psw" placeholder="Password@1" name="clientPassword" required>

                <!-- </br></br> -->
                
                <button id="login_button" type="submit">Sign In</button>

                <!-- </br></br> -->
        </form>        
        <!-- </div> -->
        <div class="register">
            <a id="register" href="../accounts/index.php?action=register">Not a member yet?</a>
        </div>
        
    </main>
    
    <!-- PHP call to the FOOTER snippet -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>

</div>
</body>
</html>