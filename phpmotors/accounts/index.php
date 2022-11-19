<?php
/*==============================\\
||                              ||  
||  ACCOUNTS CONTROLLER         ||
||                              ||
\\==============================*/

// Create or access a session
session_start();

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

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'deliverLoginView':
        $pageTitle = 'Sign In Page';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
        break;

    case 'deliverRegisterView':
        $pageTitle = 'User Registration Page';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
        break;

    case 'deliverUpdateView':
        $pageTitle = 'Sign In Page';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
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
            $message = '<p class="message">That email address already exists. Do you want to login instead?</p>';
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
            include '../view/login.php';
            exit;
        } else {
            $message = "<p class='message'>Sorry, $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            exit;
        }

        break;

    case 'Login':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $passwordCheck = checkPassword($clientPassword);
        // console_log($passwordCheck);

        // Run basic checks, return if errors
        if (empty($clientEmail) || empty($passwordCheck)) {
            $message = '<p class="notice">Please provide a valid email address and password.</p>';
            include '../view/login.php';
            exit;
        }

        // A valid password exists, proceed with the login process Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against the hashed password for the matching client
        $hashCheck = password_verify("$clientPassword", $clientData['clientPassword']);

        // If the hashes don't match create an error and return to the login view
        // THIS CODE IS NOT WORKING AND CAUSES THE PAGE TO NOT FUNCTION -- NEED TO FIX?
        // if (!$hashCheck) {
        //     $_SESSION['message'] = '<p class="message">Please check your password and try again.</p>';
        //     include '../view/login.php';
        //     exit;
        // }

        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array the array_pop function removes the last element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        console_log("Session Check");
        console_table($_SESSION['clientData']);
        // Send them to the admin view
        include '../view/admin.php';
        exit;

        break;

    case 'updateAccount':
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
            // check that values are the correct format
            $clientEmail = checkEmail($clientEmail);

            // check if the email exists
            $existingEmail = checkExistingEmail($clientEmail);

            // check for an existing email in the database
            if ($existingEmail) {
                $_SESSION['message'] = '<p class="message"> That email address already exists. Please choose another.</p>';
                include '../view/client-update.php';
                exit;
            }
        }

        // check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $_SESSION['message'] = '<p class="message"> Please provide information for all empty fields.</p>';
            include '../view/client-update.php';
            exit;
        }

        // Send data to the model
        $updateOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

        // Check and report the result
        if ($updateOutcome) {
            $_SESSION['clientData'] = getAccountByID($clientId);
            $_SESSION['message'] = '<p class="message">$clientFirstname, your information has been updated.</p>';
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $_SESSION['message'] = '<p class="message">$clientFirstname, we could not update your account information. Please try again.</p>';
            include '../view/client-update.php';
            exit;
        }

        break;

    case 'updatePassword':
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $checkPassword = checkPassword($clientPassword);

        if (empty($clientPassword) || empty($checkPassword)) {
            $_SESSION['message'] = '<p class="message">Please make sure that your password matches the required pattern.</p>';
            include '../view/client-update.php';
            exit;
        }

        // if (!empty($clientPassword) && $checkPassword) {
        //     // Hash the checked password
        //     $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        //     // Update password
        //     $updatePass = updatePassword($hashedPassword, $clientId);

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Update password
        $updatePass = updatePassword($hashedPassword, $clientId);

        if ($updatePass) {
            $clientFirstname = $_SESSION['clientData']['clientFirstname'];
            $_SESSION['message'] = '<p class="message">$clientFirstname, your password has been updated.</p>';
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $_SESSION['message'] = '<p class="message">$clientFirstname, an error occurred and your password could not be updated.</p>';
            exit;
        }

        break;

    case "logout":
        session_destroy();
        unset($_SESSION);
        setcookie('PHPSESSID', '', strtotime('-1 hour'), '/');
        header('Location: /phpmotors/');
        break;

    default:
        include '../view/admin.php';
        // break;
}
