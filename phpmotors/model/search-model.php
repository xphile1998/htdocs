<?php

/*==========================\\
||                          ||
||  SEARCH MODEL            ||
||                          ||
\\==========================*/

function searchInv($searchTxt)
{
    $sqlSearch = "'%" . $searchTxt . "%'";
    $db = phpmotorsConnect();

    $sql = "
        SELECT SQL_CALC_FOUND_ROWS * 
        FROM inventory 
        WHERE invColor LIKE {$sqlSearch} 
        OR invMake LIKE {$sqlSearch}
        OR invModel LIKE {$sqlSearch}
        OR invDescription LIKE {$sqlSearch}
        OR invPrice LIKE {$sqlSearch}
    ";

    $stmt = $db->prepare($sql);

    $stmt->execute();
    $allResults = $stmt->fetchall(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    console_table($allResults);
    return $allResults;
}

function displaySearch($results, $count)
{
    $dv = '<div class="results-container">';
    $dv .= '<h2 class="results">There are ' . $count . ' result(s): </h2>';
    $dv .= '<div id="article-container">';
    $dv .= '<ul id="results-display">';
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
