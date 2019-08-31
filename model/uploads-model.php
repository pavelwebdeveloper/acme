<?php

// The model for product image uploads

// Add image information to the database table

function storeImages($imgPath, $invId, $imgName) {
 $db = acmeConnect();
 $sql = 'INSERT INTO images (invId, imgPath, imgName) VALUES (:invId, :imgPath, :imgName)';
 $stmt = $db->prepare($sql);
 // Store the full size image information
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
 $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
 $stmt->execute();
 
 // Make and store the thumbnail image information
 // Change name in path
 $imgPath = makeThumbnailName($imgPath);
 // Change name in file name
 $imgName = makeThumbnailName($imgName);
 $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
 $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
 $stmt->execute();
 
 // Ask how many rows changed as a result of our insert
 $rowsChanged = $stmt->rowCount();
 // Ask how many rows changed as a result of our insert
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $rowsChanged;
}


// Get Image Information from images table
function getImages() {
 $db = acmeConnect();
 $sql = 'SELECT imgId, imgPath, imgName, imgDate, inventory.invId, invName FROM images JOIN inventory ON images.invId = inventory.invId';
 $stmt = $db->prepare($sql);
 $stmt->execute();
 $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $imageArray;
}

// Get Thumbnail Images from images table based on the product Id
function getThumbnailImages($invId) {
 $db = acmeConnect();
 $sql = "SELECT * FROM images WHERE invId = :invId AND imgPath LIKE '%-tn%'";
 $stmt = $db->prepare($sql);
 // The next line replaces the placeholder in the SQL
 // statement with the actual value in the variable
 // and tells the database the type of data it is
$stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
 $stmt->execute();
 $thumbnailArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $thumbnailArray;
}

// Delete image information from the images table
function deleteImage($id) {
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 /*imgId, */
 $sql = 'DELETE FROM images WHERE imgId = :imgId';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next line replaces the placeholder in the SQL
 // statement with the actual value in the variable
 // and tells the database the type of data it is
$stmt->bindValue(':imgId', $id, PDO::PARAM_INT);
 // Delete the data
 $stmt->execute();
 // Ask how many rows changed as a result of our delete
 $deleteResult = $stmt->rowCount();
 // Ask how many rows changed as a result of our delete
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $deleteResult;
}

// Check for an existing image

function checkExistingImage($imgName) {
 // Create a connection object using the acme connection function
 $db = acmeConnect();
 // The SQL statement
 $sql ='SELECT imgName FROM images WHERE imgName = :imgName';
 // The next line creates the prepared statement using the acme connection
 $stmt = $db->prepare($sql);
 // The next line replaces the placeholder in the SQL
 // statement with the actual value in the variable
 // and tell the database the type of data it is
 $stmt ->bindValue(':imgName', $imgName, PDO::PARAM_STR);
 // The next line runs the prepared statement 
 $stmt->execute();
 // The next line gets the data from the database and 
 // stores it in the $imageMatch variable.
 // We only want to get a single row from the database if a match is found, so we use a "fetch()" not a "fetchAll()".
 $imageMatch = $stmt->fetch();
 // Ask how many rows changed as a result of our delete
 $stmt->closeCursor();
 // Return the indication of success (rows changed)
 return $imageMatch;
}

