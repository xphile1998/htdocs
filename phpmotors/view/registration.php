<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel = "stylesheet" media="screen" href = "/phpmotors/css/normalize.css">
    <link rel = "stylesheet" media="screen" href = "/phpmotors/css/main.css">
    <link rel = "stylesheet" media="screen" href = "/phpmotors/css/medium.css">
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
        <h1>New Client Registration</h1>

        <form id="registration" action="/phpmotors/accounts/index.php" method="post">
            <label for="clientFirstname">First Name</label>
            <input type="text" id="clientFirstname" name="clientFirstname" required>

            <label for="clientLastname">Last Name</label>
            <input type="text" id="clientLastname" name="clientLastname" required>

            <label for="clientEmail">Email Address</label>
            <input type="email" id="clientEmail" name="clientEmail" required>

            <span>Passwords must at least 8 characters and contain at least 1 number, 1 captial letter, and 1 special character.</span>
            <label for="clientPassword">Password</label>
            <input type="password" id="clientPassword" name="clientPassword" required>
            
            <input type="submit" value="Register">
            <input type="hidden" value="registerUser">
        </form>
    </main>
    
    <hr>
    <footer>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>

</div>
</body>
</html>