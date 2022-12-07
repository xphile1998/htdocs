<?php
$server = 'localhost';
$dbname = 'my_database';
$username = 'iClient';
$password = 'A)TkEQkiK)c!A!5a';
$output = '';

$conn = mysqli_connect($server, $username, $password, $dbname);
// mysqli_select_db() or die("Could not find DB!");

//collect
if (isset($_POST['search'])) {
    $searchq = $_POST['search'];
    $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);

    $query = mysqli_query($conn, "SELECT * FROM members WHERE firstname LIKE '%$searchq%' OR lastname LIKE '%$searchq%'") or die("Could not search");
    $count = mysqli_num_rows($query);
    if ($count == 0) {
        $output = 'There was no search results';
    } else {
        while ($row = mysqli_fetch_array($query)) {
            $fname = $row['firstname'];
            $lname = $row['lastname'];
            $id = $row['id'];

            $output .= '<div> ' . $fname . ' ' . $lname . '</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>

<body>
    <form action="index.php" method="post">
        <input type="text" name="search" placeholder="Search for...">
        <input type="submit" value="Search">
    </form>

    <?php
    print("$output");
    ?>
</body>

</html>