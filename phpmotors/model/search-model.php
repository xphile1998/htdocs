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
    // stuff
}


// function searchq($searchVal)
// {
//     $server = 'localhost';
//     $username = 'iClient';
//     $password = 'A)TkEQkiK)c!A!5a';
//     $dbname = 'phpmotors';
//     $output = '';

//     $conn = mysqli_connect($server, $username, $password, $dbname);

//     //collect
//     if (isset($_POST[$searchVal])) {
//         $searchq = $_POST[$searchVal];
//         $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);

//         $query = mysqli_query($conn, "SELECT * FROM members WHERE firstname LIKE '%$searchq%' OR lastname LIKE '%$searchq%'") or die("Could not search");
//         $count = mysqli_num_rows($query);
//         if ($count == 0) {
//             $output = 'There was no search results';
//         } else {
//             while ($row = mysqli_fetch_array($query)) {
//                 $make = $row['invMake'];
//                 $model = $row['invModel'];
//                 $description = $row['invDescription'];
                
//                 $output .= '<div class="searchResult">
//                             <span class="resTitle">' . $make . ' ' . $model . '</span>
//                             <span class="resDesc">' . $description . '</span>
//                             </div>';
//             }
//         }
//     }
//     echo ($output);
// }
