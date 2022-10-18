<?php
/*==============================\\
||                              ||  
||  VEHICLES CONTROLLER         ||
||                              ||
\\==============================*/

/*======================================================\\
||  We are going to get the following support files:    ||
||    + Database connection file                        ||
||    + Main Model file                                 ||
||    + Vehicles Model file                             ||
\\======================================================*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';

// Get the array of classifications
$classifications = getClassifications();
$classificationList = getClassificationList();

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
    case 'addVehicle':
        // Seeing where we are getting to
        // echo "<script>console.log('Debug Point: Adding Vehicle - Entered');</script>";
        
        // Collect, filter, and store user data
        $invMake = filter_input(INPUT_POST, 'invMake');
        $invModel = filter_input(INPUT_POST, 'invModel');
        $invDescription = filter_input(INPUT_POST, 'invDescription');
        $invPrice = filter_input(INPUT_POST, 'invPrice');
        $invStock = filter_input(INPUT_POST, 'invStock');
        $invColor = filter_input(INPUT_POST, 'invColor');
        $classificationId = filter_input(INPUT_POST, 'classificationId');

        // What is the state of the values sent over?
        // echo "<script>console.log(`$invMake, $invModel, $invDescription, $invPrice, $invStock, $invColor, $classificationId`);</script>";

        // Check to see if any data is missing
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $message = '<p class="message">Please provide all the information from the empty fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
            exit;
        }

        $addVehicleOutcome = addVehicle($invMake, $invModel, $invDescription, $invPrice, $invStock, $invColor, $classificationId);

        // Check out the result of the INSERT into the database
        if ($addVehicleOutcome === 1) {
            $message = '<p class="message">Thanks for adding the $invModel.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
            exit;
        } else {
            $message = '<p class="message">Sorry, but adding $invModel failed. Please try again.</p>';
            include $_SERVER['DOCUMNET_ROOT'] . '/phpmotors/view/add-vehicle.php';
            exit; 
        }     
        
        break;

    case 'registerUser':
        // Collect, filter, and store the user data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
        $clientLastname = filter_input(INPUT_POST, 'clientLastname');
        $clientEmail = filter_input(INPUT_POST, 'clientEmail');
        $clientPassword = filter_input(INPUT_POST, 'clientPassword');

        // Check to see if there is any missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
            $message = '<p class="message">Please provide all the information for all empty fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
            exit;
        }

        // Send the data to the database
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

        // Check out the result of the INSERT into the database
        if ($regOutcome === 1) {
            $message = '<p class="message">Thanks for registering $clientFirstname. Please use your email and password to login.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            exit;
        } else {
            $message = '<p class="message">Sorry, $clientFirstname, but the registration failed. Please try again.</p>';
            include $_SERVER['DOCUMNET_ROOT'] . '/phpmotors/view/registration.php';
            exit; 
        }
        
        break;

    default:
        $pageTitle = 'Vehicle Management Page';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/views/vehicle-man.php';
        break;
}
