<?php
// This is the accounts controller for the site

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';

// Get the PHP Motors Model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';

// Get the array of classifications
$classifications = getClassifications();
// var_dump($classifications);
// exit;

// Build a navigation bar using the $classifications arrary
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';
// echo $navList;
// exit;

$action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }

switch ($action) {
    case 'deliveringRegisterView': 
        include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/registration.php';
        break;

    default:
        include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/login.php';
        break;
}