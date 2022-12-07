<?php

/*==========================\\
||                          ||
||  SEARCH MODEL            ||
||                          ||
\\==========================*/

function searchInv($search)
{
    $db = phpmotorsConnect();
    $sqlSearch = '%' . $search . '%';
    $sql = `SELECT *
            FROM inventory
            WHERE invColor LIKE {$sqlSearch}
                OR invMake LIKE {$sqlSearch}
                OR invModel LIKE {$sqlSearch}
                OR invDescription LIKE {$sqlSearch}
                OR invPrice LIKE {$sqlSearch}`;
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $allResults = $stmt->fetchall(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    console_table($allResults);
    return $allResults;
}

function displaySearch($results)
{
    
}
