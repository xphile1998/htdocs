<?php
/*==============================\\
||                              ||  
||  VEHICLES CONTROLLER         ||
||                              ||
\\==============================*/

// Create or access a session
session_start();

/*======================================================\\
||  We are going to get the following support files:    ||
||    + Database connection file                        ||
||    + Main Model file                                 ||
||    + Vehicles Model file                             ||
||    + Functions file
\\======================================================*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
$classificationsList = getClassificationList();
$navList = buildNavList($classifications);

// Default Page Title
$pageTitle = 'Vehicles';

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
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId',));

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
            $message = "<p class='message'>Thanks for adding the $invModel.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
            exit;
        } else {
            $message = "<p class='message'>Sorry, but adding $invModel failed. Please try again.</p>";
            include $_SERVER['DOCUMNET_ROOT'] . '/phpmotors/view/add-vehicle.php';
            exit;
        }

        break;

    case 'deliverAddVehicle':
        $pageTitle = 'Add Vehicle';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
        break;

    case 'deliverAddClassification':
        $pageTitle = 'Add Classification';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
        break;

    case 'addClassification':
        // Collect the data for this case
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING));

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
            $message = "<p class='message'>Sorry, but adding $classificationName failed. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
            exit;
        }

        break;

    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */
    case 'getInventoryItems':
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray);
        break;

    default:
        $pageTitle = 'Vehicle Management Page';
        $classificationList = buildClassificationList($classifications);
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
        break;
}
