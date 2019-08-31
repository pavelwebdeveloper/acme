<?php

/* 
 * Accounts Model for site visitors
 */

// Insert site visitor data to database

function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword) VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next four lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tell the database the type of data it is
 $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
 $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
 $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
 $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Ask how many rows changed as a result of our insert
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}

// Check for an existing email address

function checkforExistingemail($clientEmail) {
  // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 $sql ='SELECT clientEmail FROM clients WHERE clientEmail = :email';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next line replaces the placeholder in the SQL
 // statement with the actual value in the variable
 // and tell the database the type of data it is
 $stmt ->bindValue(':email', $clientEmail, PDO::PARAM_STR);
 // The next line runs the prepared statement 
 $stmt->execute();
 // The next line gets the data from the database and 
 // stores it as simple numeric array in the $matchEmail variable by adding a parameter to the fetch of " PDO::FETCH_NUM".
 // We only want to get a single row from the database if a match is found, so we use a "fetch()" not a "fetchAll()".
 $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
 // Ask if the array is empty or not
 if(empty($matchEmail)) {
  return 0;  
 } else {
  return 1;
 }
}

// Get client data based on an email address
function getClient($clientEmail){
 $db = acmeConnect();
 $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :email';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
 $stmt->execute();
 $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $clientData;           
}

// Selecting a single product information based on its id (invId)

function getClientinfo($clientId){
 $db = acmeConnect();
 $sql = 'SELECT * FROM clients WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();
  $clientInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientInfo;
}

// Update an existing client data in the clients table in the database

function updateClientaccount($clientFirstname, $clientLastname, $clientEmail, $clientId) {
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 /*categoryId, */
 $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tell the database the type of data it is
 $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
 $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
 $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
 $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Ask how many rows changed as a result of our insert
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}


// Get client data based on client ID
function getClientupdateddata($clientId){
 $db = acmeConnect();
 $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel FROM clients WHERE clientId = :clientId';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
 $stmt->execute();
 $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $clientData;           
}

// Update the password data in the clients table in the database

function updatePassword($clientPassword, $clientId) {
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 /*categoryId, */
 $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tell the database the type of data it is
 $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
 $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Ask how many rows changed as a result of our insert
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}