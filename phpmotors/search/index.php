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
||    + Search Model file                               ||
\\======================================================*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/vehicles-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/search-model.php';

// Get the array of classifications
$classifications = getClassifications();
$classificationsList = getClassificationList();
$navList = buildNavList($classifications);

// Default Page Title
$pageTitle = 'Search';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'search':
        $_SESSION['message'] = null;
        $searchTxt = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
        $searchTxt = checkSearch($searchTxt);
        

        // Check for input
        if (empty($searchTxt)) {
            $_SESSION['message'] = '<p class="message">Please provide something to search for.</p>';
            include '../view/search.php';
            exit;
        }

        // If there is $searchTxt to search for
        $searchData = searchInv($searchTxt);
        
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/search.php';
        break;

    default:
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/search.php';
        exit;
        break;
}
