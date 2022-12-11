<?php

$searchTxt = "the";
$sqlSearch = "'%" . $searchTxt . "%'";
$db = phpmotorsConnect();

// User input
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = isset($_GET['per-page']) && $_GET['per-page'] <= 5 ? (int)$_GET['per-page'] : 3;

// Positioning
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

// Query
$results = $db->prepare("
    SELECT SQL_CALC_FOUND_ROWS * 
    FROM inventory 
    WHERE invColor LIKE {$sqlSearch} 
    OR invMake LIKE {$sqlSearch}
    OR invModel LIKE {$sqlSearch}
    OR invDescription LIKE {$sqlSearch}
    OR invPrice LIKE {$sqlSearch}
    LIMIT {$start}, {$perPage}
");

$results->execute();

$results = $results->fetchAll(PDO::FETCH_ASSOC);

// Pages
$total = $db->query("SELECT FOUND_ROWS() as total")->fetch()['total'];
$pages = ceil($total / $perPage);

/*==================================================================\\
||                                                                  ||
||  Temporary Connection to the phpmotors DB                        ||
||                                                                  ||
\\==================================================================*/
function phpmotorsConnect() {
    $server = 'localhost';
    $dbname = 'phpmotors';
    $username = 'iClient';
    $password = 'A)TkEQkiK)c!A!5a';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $link = new PDO($dsn, $username, $password, $options);
        // if(is_object($link)) {
        //     echo 'It worked!';
        // }
        return $link;
    } catch(PDOException $e) {
        header('Location: /phpmotors/view/500.php');
        exit;
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        .pagination a.selected {
            background-color: blue;
            color: white;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <?php foreach($results as $result): ?>
        <div class="result">
            <p><?php echo $result['invMake'] . ' ' . $result['invModel']; ?></p>
            <p><?php echo $result['invDescription']; ?></p>
            <hr>
        </div>
    <?php endforeach; ?>
    <div class="pagination">
        <?php for($x = 1; $x <= $pages; $x++): ?> 
            <a href="?page=<?php echo $x; ?>&per-page=<?php echo $perPage; ?>"<?php if($page === $x) { echo ' class="selected"'; } ?>><?php echo $x; ?></a>
        <?php endfor; ?>
    </div>
</body>
</html>