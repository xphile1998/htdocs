<?php
/*==============================\\
||                              ||  
||  MAIN CONTROLLER             ||
||                              ||
\\==============================*/

// Create or access a session
session_start();

/*======================================================\\
||  We are going to get the following support files:    ||
||    + Database connection file                        ||
||    + Main Model file                                 ||
||    + Functions file                                  ||
\\======================================================*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/functions.php';


// Get the array of classifications
$classifications = getClassifications();
$navList = buildNavList($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'template':
        include 'view/template.php';
        break;

    default:
        include 'view/home.php';
        break;
}
?>