<?php
/*==========================\\
||                          ||
||  Functions Library       ||
||                          ||
\\==========================*/

function checkEmail($clientEmail)
{
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

/*======================================================\\
||  Check the password for a minimum of 8 characters,   ||
||  at least 1 capital letter, at least 1 number and    ||
||  at least 1 special character.                       ||
\\======================================================*/
function checkPassword($clientPassword)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';

    return preg_match($pattern, $clientPassword);
}

// Build a navigation bar using the $classifications array
function buildNavList($classifications)
{
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li>
        <a href='/phpmotors/vehicles/?action=classification&classificationName="
            . urlencode($classification['classificationName']) .
            "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a>
        </li>";
    }
    $navList .= '</ul>';

    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications)
{
    $classificationList = '<select name="classificationId" id="classificationList">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}

function buildVehiclesDisplay($vehicles)
{
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $dv .= '<li class="vehicle">';
        $dv .= "<a href='../vehicles/?action=vehicleView&vehicleId=$vehicle[invId]'>";
        $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<span>$vehicle[invPrice]</span>";
        $dv .= '</a>';
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

function vehicleDetailsPage($vehicle)
{
    $price = number_format($vehicle['invPrice'], 2, ".", ",");
    $dv = "<h1 id='carName'>$vehicle[invMake] $vehicle[invModel]</h1>";
    $dv .= "<span id='photo'><img src='$vehicle[invImage]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></span>";
    $dv .= "<p id='price'>Price: $$price</p>";
    $dv .= '<hr>';
    $dv .= "<div id='description'>";
    $dv .= "<h2>$vehicle[invMake] $vehicle[invModel] Details</h2>";
    $dv .= "<p>$vehicle[invDescription]</p>";
    $dv .= "</div>";
    $dv .= "<p id='carColor'><b>Color: </b>$vehicle[invColor]</p>";
    $dv .= "<p id='quantity'><b>Quantity in Stock: </b>$vehicle[invStock]</p>";
    
    return $dv;
}

// Prints a variable out to the console
function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

// Prints an array or object out to the console
function console_table($output, $with_script_tags = true)
{
    $js_code = 'console.table(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
