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
||    + Functions file                                  ||
\\======================================================*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/accounts_model.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

// Default Page Title
$pageTitle = 'Accounts';

// Build a navigation bar using the $classifications arrary
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

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
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

        // Validate EMAIL and PASSWORD
        // $clientEmail = checkEmail($clientEmail);
        // $clientPassword = checkPassword($clientPassword);

        // Check to see if this EMAIL already exists in the Clients table
        // $existingEmail = checkExistingEmail($clientEmail);
        // if ($existingEmail) {
        //     $_SESSION['message'] = '<p class="notice">That email already exists in our database. Do you want to login instead?</p>';
        //     include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
        //     exit;
        // }

        // Check to see if there is any missing data
        if (empty($clientFirstName) || empty($clientLastName) || empty($clientEmail) || empty($clientPassword)) {
            $_SESSION['message'] = '<p class="notice">Please provide all the information for all empty fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
            exit;
        }

        // Send the data to the database
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

        // Check out the result of the INSERT into the database
        if ($regOutcome === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), "/");
            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
            header('location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry, $clientFirstname, but the registration failed. Please try again.</p>";
            include $_SERVER['DOCUMNET_ROOT'] . '/phpmotors/view/registration.php';
            exit; 
        }
        
        break;

    default:
        // echo 'There is currently nothing for this to go to as a default. Sorry!';
        break;
}
