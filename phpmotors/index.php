<?php
/*==============================\\
||                              ||  
||  MAIN CONTROLLER             ||
||                              ||
\\==============================*/

/*======================================================\\
||  We are going to get the following support files:    ||
||    + Database connection file                        ||
||    + Main Model file                                 ||
\\======================================================*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

// Get the array of classifications
$classifications = getClassifications();

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
    case 'template':
        include 'view/template.php';
        break;

    default:
        include 'view/home.php';
        break;
}
