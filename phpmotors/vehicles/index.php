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
$classificationsList = getClassificationList();

$message = "";

// Default Page Title
$pageTitle = 'Accounts';

// Build a navigation bar using the $classifications arrary
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

// Build a Select List for classificationName for adding a vehicle
$selectList = "<select id='classificationId' name='classificationId'>";
    foreach ($classificationsList as $selectItem) {
        $selectList .= "<option value='$selectItem[classificationId]'>$selectItem[classificationName]</option>";
    }
$selectList .= "</select>";

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

    case 'addClassification':
        // Collect the data for this case
        $classificationName = filter_input(INPUT_POST, 'classificationName');
        
        // Check if input is empty
        if (empty($classificationName)) {
            $message = "<p class='message'>Please be sure to fill out the entire form before submitting.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
            exit;
        }
        
        $addClassificationOutcome = addClassification($classificationName);

        // Check for the insertion into the database
        if ($addClassificationOutcome === 1) {
            $message = "<p class='message'>Thank you for adding $classificationName.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
            exit;
        } else {
            $message = '<p class="message">Sorry, but adding $classificationName failed. Please try again.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
            exit;
        }

        break;

    default:
        $pageTitle = 'Vehicle Management Page';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
        break;
}
