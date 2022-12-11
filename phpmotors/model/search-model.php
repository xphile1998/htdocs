<?php

/*==========================\\
||                          ||
||  SEARCH MODEL            ||
||                          ||
\\==========================*/

function searchInv($searchTxt)
{   // Setting up data for the SELECT function
    $sqlSearch = "'%" . $searchTxt . "%'";
    $db = phpmotorsConnect();

    // Page positioning data
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perPage = isset($_GET['per-page']) && $_GET['per-page'] <= 5 ? (int)$_GET['per-page'] : 3;
    $start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

    // Crafting the SQL Query
    $sql = "
        SELECT SQL_CALC_FOUND_ROWS * 
        FROM inventory 
        WHERE invColor LIKE {$sqlSearch} 
        OR invMake LIKE {$sqlSearch}
        OR invModel LIKE {$sqlSearch}
        OR invDescription LIKE {$sqlSearch}
        OR invPrice LIKE {$sqlSearch}
        LIMIT {$start}, {$perPage}
    ";

    $stmt = $db->prepare($sql);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    console_table($results);

    // Pages
    $total = $db->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
    $pages = ceil($total / $perPage);

    return displaySearch($results, $total, $page, $pages, $perPage);

    // return $results;
}

function displaySearch($results, $total, $page, $pages, $perPage)
{
    $dv = '<div class="results-container">';
    $dv .= '<h2 class="results">There are ' . $total . ' result(s): </h2>';
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
    };

    $dv .= '</ul>';
    $dv .= '</div>';
    $dv .= '</div>';

    $dv .= '<div class="pagination">';
    for ($x = 1; $x <= $pages; $x++) {
        $classChg = "";
        if ($page === $x) {
            $classChg = "selected";
        }
        $dv .= '<a href="?page=' . $x . '&per-page=' . $perPage . '" class="pages ' . $classChg . '" >' . $x . '</a>';
    };
    $dv .= '</div>';


    return $dv;
}
