<?php

/* 
 * This is the Products Model
 */

// Insert a new category data into the categories table in the database

function addCategory($categoryName) {
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 $sql = 'INSERT INTO categories (categoryName) VALUES (:categoryName)';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next line replaces the placeholder in the SQL
 // statement with the actual value in the variable
 // and tells the database the type of data it is
 $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Ask how many rows changed as a result of our insert
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}

// Insert a new product data into the inventory table in the database

function addProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle) {
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 /*categoryId, */
 $sql = 'INSERT INTO inventory (categoryId, invName, invDescription, invImage, invThumbnail, invPrice, invStock, invSize, invWeight, invLocation, invVendor, invStyle) VALUES (:categoryId, :invName, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invSize, :invWeight, :invLocation,  :invVendor, :invStyle)';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next four lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tell the database the type of data it is
 $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
 $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
 $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
 $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
 $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
 $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
 $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
 $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
 $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
 $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
 $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
 $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Ask how many rows changed as a result of our insert
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}

// Get basic product information from the inventory table for starting an update or delete process
function getProductBasics() {
 $db = acmeConnect();
 $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $products;
}

// Selecting a single product information based on its id (invId)

function getProductInfo($invId){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE invId = :invId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
  $stmt->execute();
  $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $prodInfo;
}

// Update an existing product data in the inventory table in the database

function updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $invVendor, $invStyle, $invId) {
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 /*categoryId, */
 $sql = 'UPDATE inventory SET categoryId = :categoryId, invName = :invName, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, invStock = :invStock, invSize = :invSize, invWeight = :invWeight, invLocation = :invLocation, invVendor = :invVendor, invStyle = :invStyle WHERE invId = :invId';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tell the database the type of data it is
 $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
 $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
 $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
 $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
 $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
 $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
 $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
 $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
 $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
 $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
 $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
 $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Ask how many rows changed as a result of our insert
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}

// Delete an existing product data in the inventory table in the database

function deleteProduct($invId) {
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 /*categoryId, */
 $sql = 'DELETE FROM inventory WHERE invId = :invId';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next line replaces the placeholder in the SQL
 // statement with the actual value in the variable
 // and tells the database the type of data it is
$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 // Delete the data
 $stmt->execute();
 // Ask how many rows changed as a result of our delete
 $rowsChanged = $stmt->rowCount();
 // Ask how many rows changed as a result of our delete
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}

// Get a list of products based on the category

function getProductsByCategory($categoryName){
  // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 /*categoryId, */
 $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :categoryName)';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
  $stmt->execute();
  $products = $stmt->fetchall(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $products;
}

// Selecting a default single product information based on its id (invId) for a default display

function getDefaultProdInfo() {
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE invId = 1';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $prodInfo;
}

// Selecting the featured product information based on its id (invId)

function getFeaturedProductInfo(){
 $db = acmeConnect();
 $sql = 'SELECT * FROM inventory WHERE invFeatured = TRUE';
  $stmt = $db->prepare($sql);
  $stmt->execute();
  $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $prodInfo;
}

// Setting the current selected product to a featured status 

function makeNewFeaturedProd($invId){
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 /*categoryId, */
 $sql = 'UPDATE inventory SET invFeatured = TRUE WHERE invId = :invId';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tell the database the type of data it is
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Ask how many rows changed as a result of our insert
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}

// Setting the current featured product to an unfeatured status 

function cancelCurrentFeaturedProd() {
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 /*categoryId, */
 $sql = 'UPDATE inventory SET invFeatured = NULL WHERE invFeatured = TRUE';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Ask how many rows changed as a result of our insert
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}

// Another option of code for setting the current selected product to a featured status

/*function makeNewFeaturedProd($invId, $invFeatured){
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 $sql = 'UPDATE inventory SET invFeatured = :invFeatured WHERE invId = :invId';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tell the database the type of data it is
 $stmt->bindValue(':invFeatured', $invFeatured, PDO::PARAM_BOOL);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Ask how many rows changed as a result of our insert
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}*/

// Another option of setting the current featured product to an unfeatured status

/*function cancelCurrentFeaturedProd($invFeatured) {
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 $sql = 'UPDATE inventory SET invFeatured = :invFeatured WHERE invFeatured = TRUE';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next lines replace the placeholders in the SQL
 // statement with the actual values in the variables
 // and tell the database the type of data it is
 $stmt->bindValue(':invFeatured', $invFeatured, PDO::PARAM_BOOL);
 // $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 // Insert the data
 $stmt->execute();
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Ask how many rows changed as a result of our insert
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}*/