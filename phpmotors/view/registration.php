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
    <!-- PHP call to the HEADER snippet -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

    <!-- PHP call to the NAV snippet -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>

    <main>
        <h1>New Client Registration</h1>

        <div id="registration">
            <label for="firstName">First Name</label>
            <input type="text" placeholder="First Name" name="clientFirstname" required>
            <label for="lastName">Last Name</label>
            <input type="text" placeholder="Last Name" name="clientLastname" required>
            <label for="email">Email Address</label>
            <input type="email" placeholder="username@email.com" name="clientEmail" required>
            <p>Passwords must at least 8 characters and contain at least 1 number, 1 captial letter, and 1 special character.</p>
            <label for="password">Password</label>
            <input type="password" placeholder="Password@1" name="clientPassword">

            <i class="fa-solid fa-eye" id="eye">Show Password</i>

            </br>

            <button id="signUpBtn" type="submit">Register</button>

        </div>
    </main>
    
    <!-- PHP call to the FOOTER snippet -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>

</div>
</body>
</html>