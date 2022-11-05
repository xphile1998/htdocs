<?php
/*==============================\\
||                              ||  
||  ACCOUNTS CONTROLLER         ||
||                              ||
\\==============================*/

/*======================================================\\
||  We are going to get the following support files:    ||
||    + Database connection file                        ||
||    + Main Model file                                 ||
||    + Accounts Model file                             ||
||    + Functions library file
\\======================================================*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/accounts-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
$navList = buildNavList($classifications);

// Default Page Title
$pageTitle = 'Accounts';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'deliverLoginView':
        $pageTitle = 'Sign In Page';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
        break;

    case 'loginUser':
        echo "You've made it to the LOGIN USER switch case.";
        break;

    case 'deliverRegisterView':
        $pageTitle = 'User Registration Page';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
        break;

    case 'registerUser':
        // Collect, filter, and store the user data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        $existingEmail = checkExistingEmail($clientEmail);

        // Check to see if the email address already exists
        if ($existingEmail) {
            $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }

        // Check to see if there is any missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $message = "<p class='message'>Please provide all the information for all empty fields.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
            exit;
        }

        // Hash the password 
        $hashedPassword = password_hash($checkPassword, PASSWORD_DEFAULT);

        // Send the data to the database
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check out the result of the INSERT into the database
        if ($regOutcome === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $message = "<p class='message'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            exit;
        } else {
            $message = "<p class='message'>Sorry, $clientFirstname, but the registration failed. Please try again.</p>";
            include $_SERVER['DOCUMNET_ROOT'] . '/phpmotors/view/registration.php';
            exit;
        }

        break;

    case 'Login':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = checkEmail($clientEmail);
        // $checkPassword = checkPassword($clientPassword);

        // Check to see if there is any missing data
        if (empty($clientEmail) || empty($checkPassword)) {
            $message = "<p class='message'>Please provide all the information for all empty fields.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            exit;
        }

        // Query the client database to check that the email exists
        $clientData = getClient($clientEmail);

        // Verify the password against the hashed password
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // Return an error if the password does not match
        if (!$hashCheck) {
            $message = '<p class="message">Please check your password and try again.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            exit;
        }

        // If the password passes check, proceed to log them in
        $_SESSION['loggedin'] = TRUE;
        array_pop($clientData);
        $_SESSION['clientData'] = $clientData;
        // include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
        echo "<script>console.log('Debugging data:" . $clientData . "');</script>";
        exit;

        break;

    default:
        // echo 'There is currently nothing for this to go to as a default. Sorry!';
        break;
}
