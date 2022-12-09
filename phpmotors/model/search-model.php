<?php

/*==========================\\
||                          ||
||  SEARCH MODEL            ||
||                          ||
\\==========================*/

function searchInv($searchTxt)
{
    // console_log('You are in the searchInv function');
    $db = phpmotorsConnect();
    $sqlSearch = "'%" . $searchTxt . "%'";
    // console_log("This is the value of sqlSearch: ");
    // console_log($sqlSearch);
    $sql = "SELECT * FROM inventory WHERE invColor LIKE ". $sqlSearch ." OR invMake LIKE ". $sqlSearch ." OR invModel LIKE ". $sqlSearch ." OR invDescription LIKE ". $sqlSearch ." OR invPrice LIKE ". $sqlSearch;
    // console_log("This is the value of sql: ");
    // console_log($sql);

    $stmt = $db->prepare($sql);
    // $stmt->bindValue(':sqlSearch', $sqlSearch, PDO::PARAM_STR);
    // console_log("This is the value of stmt: ");
    // console_log($stmt);

    $stmt->execute();
    $allResults = $stmt->fetchall(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    console_table($allResults);
    return $allResults;
}

function displaySearch($results)
{
    // console_log('You are in the displayResults function');
    
    $dv = '<ul id="results-display">';
    foreach ($results as $result) {
        $dv .= '<li class="searchRes">';
        $dv .= "<a href='../vehicles/?action=vehicleView&vehicleId=$result[invId]'>";
        $dv .= "<img src='$result[invThumbnail]' alt='Image of $result[invMake] $result[invModel] on phpmotors.com'>";
        $dv .= "<h2>$result[invMake] $result[invModel]</h2>";
        $dv .= '</a>';
        $dv .= "<span>$result[invDescription]</span>";
        $dv .= '<hr>';
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

