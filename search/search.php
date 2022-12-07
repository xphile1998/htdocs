<?php
$server = 'localhost';
$username = 'iClient';
$password = 'A)TkEQkiK)c!A!5a';
$dbname = 'my_database';
$output = '';

$conn = mysqli_connect($server, $username, $password, $dbname);
// mysqli_select_db() or die("Could not find DB!");

//collect
if (isset($_POST['searchVal'])) {
    $searchq = $_POST['searchVal'];
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
echo($output);
?>