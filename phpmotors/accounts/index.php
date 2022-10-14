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
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';

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
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
        break;

    case 'deliverRegisterView':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
        break;

    default:
        // echo 'There is currently nothing for this to go to as a default. Sorry!';
        break;
}
