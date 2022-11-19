<?php

/*==========================\\
||                          ||
||  ACCOUNTS MODEL          ||
||                          ||
\\==========================*/

// Register a new client from the form
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
        VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Check to see if an email address already has an existing account
function checkExistingEmail($clientEmail)
{
    $db =  phpmotorsConnect();
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if (empty($matchEmail)) {
        return 0;
        // echo 'Nothing Found';
        // exit;
    } else {
        return 1;
        // echo 'Match Found';
        // exit;
    }
}

// Fetch the client data based on the email address
function getClient($clientEmail)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword 
            FROM clients 
            WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    console_table($clientData);
    return $clientData;
}

// Fetch the client data based on the clientID
function getAccountByID($clientId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT * 
            FROM clients 
            WHERE clientId = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $clientId, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    console_table($clientData);
    return $clientData;
}

// Apply updates to the client record
function updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId)
{
    // Create a connection object using the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'UPDATE clients
            SET clientFirstname = :firstName, clientLastname = :lastName, clientEmail = :email
            WHERE clientId = :clientId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':firstName', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':lastName', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Update the client password
function updatePassword($hashedPassword, $clientId)
{
    $db = phpmotorsConnect();
    // The SQL statement
    $sql = 'UPDATE clients
            SET clientPassword = :hashedPassword
            WHERE clientId = :clientId';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':hashedPassword', $hashedPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}
