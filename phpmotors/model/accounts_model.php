<?php

/*==========================\\
||                          ||
||  ACCOUNTS MODEL          ||
||                          ||
\\==========================*/

function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
    // Connect to the phpmotors database
    $db = phpmotorsConnect();
    // The SQL statment needed to insert the new client into the clients table in the phpmotors database
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
        VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    // Create a prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next few lines will insert the actual values into the placeholders above
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    // Insert the data 
    $stmt->execute();
    // Ask how many rows changed as a result of the INSERT
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the $rowsChanged data to show success
    return $rowsChanged;
}

