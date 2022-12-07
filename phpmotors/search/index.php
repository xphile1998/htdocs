<?php
/*==============================\\
||                              ||  
||  SEARCH CONTROLLER           ||
||                              ||
\\==============================*/

// Create or access a session
session_start();

/*======================================================\\
||  We are going to get the following support files:    ||
||    + Database connection file                        ||
||    + Main Model file                                 ||
||    + Vehicles Model file                             ||
||    + Functions file                                  ||
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
$pageTitle = 'Search';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case "search":

        break;

    default:
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/search.php';
        exit;
        break;
}
