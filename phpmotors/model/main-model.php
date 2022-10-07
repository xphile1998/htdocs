<?php
// This is the Main PHP Motors Model



function getClassifications() {
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL query to be used with the database
    $sql = 'SELECT classificationName FROM carclassification ORDER BY classificationName ASC';
    // Next line creates the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next line runs the prepared statement
    $stmt->execute();
    // The next line gets the data from the database and
    // stores it as an array in the $classifications variable
    $classifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // the next line closes the interaction with the database
    $stmt->closeCursor();
    // The next line send the array of data back to thwhere the function
    // was called (this should be the controller)
    return $classifications;
}