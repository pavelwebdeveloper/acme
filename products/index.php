<?php

/*This is the Products Controller */

// Create or access a Session
session_start();

$catList = null;

 // Get the database connection file
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
 // Get the products model
 require_once '../model/products-model.php';
 // Get the uploads model
 require_once '../model/uploads-model.php';
 // Get the functions library
 require_once '../library/functions.php';
  
 // Get the array of categories
 $categories = getCategories();
 
 // next two lines are for testing only in order to check if $categories works;
 /* var_dump($categories);
 exit; */

// call to a function that creates the main navigation menu
 $navList = buildmainNavigation($categories);
 // next two lines are only for testing  in order to check if $navList works;
 /* echo $navList;
 exit; */
 
  // Check if the firstname cookie exists, get its value
 if(isset($_COOKIE['firstname'])){
$cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
$greeting = "<span>Welcome " . $cookieFirstname . "</span>";
 } else {
  $greeting = "";
 }
 
 // Build a dynamic drop-down select list using the $categories array
 // $catList .= '<select name="categoryId" id="categoryId">';
 // $catList .= '<option disabled selected>Choose a category</option>';
//  foreach ($categories as $category) {
 /*$catList .= "<option value=".urlencode($category['categoryId']).">".urlencode($category['categoryName'])."</option>";*/
// $catList .= "<option value='$category[categoryId]'>$category[categoryName]</option>";
 // }
 // $catList .= '</select>';
 // next two lines are only for testing  in order to check if $catList works;
 /* echo $catList;
 exit; */
 
 // Get the value from the action name - value pair
 $action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 
 switch ($action){
  // Code to deliver the views
  case 'addcategory':
    include '../view/add-category.php';
   break;
  case 'newcategory':
   // Filter and store the data
   $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
   
   // validate the categoryName variable using a custom function from functions.php
   $checkcategoryName = checkcategoryName($categoryName);
   
   // Check for missing data
   if(empty($checkcategoryName)){
    $message = '<p class="messageinvitation">Please, provide a new category name.</p>';
    include '../view/add-category.php';
    exit;
   }
   
   // Send the data to the model
   $addcategoryOutcome = addCategory($categoryName);
   
   // Check and report the result
   if($addcategoryOutcome === 1){
   header('location: /backendprojects/phpprojects/acme/products/index.php');
   exit;
   } else {
    $message = "<p class='messagefailure'>Sorry, a new category has not been added. Please, try again.</p>";
            include '../view/add-category.php';
    exit;
   }
   break;
  case 'addproduct':
    include '../view/add-product.php';   
   break;
  case 'newproduct':
   // Filter and store the data
   $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
   $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
   $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
   $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
   $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
   $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
   $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
   $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
   $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
   $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
   
   // validate the variables using the custom functions from functions.php
   $checkinvName = checkinvName($invName);
   $checkinvImage = checkinvImage($invImage);
   $checkinvThumbnail = checkinvThumbnail($invThumbnail);
   $checkinvLocation = checkinvLocation($invLocation);
   $checkinvVendor = checkinvVendor($invVendor);
   $checkinvStyle = checkinvStyle($invStyle);
   
   
   // Check for missing data
   if(empty($categoryId) || empty($checkinvName) || empty($invDescription) || empty($checkinvImage) || empty($checkinvThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($checkinvLocation) ||  empty($checkinvVendor)|| empty($checkinvStyle)){
    $message = '<p class="messageinvitation">Please, provide correct information for all form fields.</p>';
    include '../view/add-product.php';
    exit;
   }
   
    // Send the data to the model
   $addproductOutcome = addProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation,  $invVendor, $invStyle);
   
   // Check and report the result
   if($addproductOutcome === 1){
    $message = "<p class='messagesuccess'>Congratulations, the $invName Product has been successfully added.</p>"; 
    $categoryId = '';
   $invName = '';
   $invDescription = '';
   $invImage = '';
   $invThumbnail = '';
   $invPrice = '';
   $invStock = '';
   $invSize = '';
   $invWeight = '';
   $invLocation = '';
   $invVendor = '';
   $invStyle = '';
    include '../view/add-product.php';
   exit;
   } else {
    $message = "<p class='messagefailure'>Sorry, the new product has not been added. Please, try again.</p>";
            include '../view/add-product.php';
    exit;
   }
   break;
  case 'mod':
   $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
   $prodInfo = getProductInfo($invId);
   if(count($prodInfo) < 1){
    $message = 'Sorry, no product information could be found.';
   }
   include '../view/product-update.php';
   exit;
   break;
  case 'updateProd':
   $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_SANITIZE_NUMBER_INT);
   $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
   $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
   $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
   $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
   $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
   $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
   $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
   $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
   $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
   $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
   
   // validate the variables using the custom functions from functions.php
   $checkinvName = checkinvName($invName);
   $checkinvImage = checkinvImage($invImage);
   $checkinvThumbnail = checkinvThumbnail($invThumbnail);
   $checkinvLocation = checkinvLocation($invLocation);
   $checkinvVendor = checkinvVendor($invVendor);
   $checkinvStyle = checkinvStyle($invStyle);
   
   
   // Check for missing data
   if(empty($categoryId) || empty($checkinvName) || empty($invDescription) || empty($checkinvImage) || empty($checkinvThumbnail) || empty($invPrice) || empty($invStock) || empty($invSize) || empty($invWeight) || empty($checkinvLocation) ||  empty($checkinvVendor)|| empty($checkinvStyle)){
    $message = '<p class="messageinvitation">Please, provide correct information for all form fields! Double check the category of the item.</p>';
    include '../view/product-update.php';
    exit;
   }
   
    // Send the data to the model
   $updateproductOutcome = updateProduct($categoryId, $invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation,  $invVendor, $invStyle, $invId);
   
   // Check and report the result
   if($updateproductOutcome === 1){
    $message = "<p class='messagesuccess'>Congratulations, $invName has been successfully updated.</p>";
    $_SESSION['message']= $message;
    header('location: /backendprojects/phpprojects/acme/products/');
   exit;
   } else {
    $message = "<p class='messagefailure'>Sorry, $invName has not been updated. Please, try again.</p>";
            include '../view/product-update.php';
    exit;
   }
   break;
  case 'del':
   $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
   $prodInfo = getProductInfo($invId);
   if(count($prodInfo) < 1){
    $message = 'Sorry, no product information could be found.';
   }
   include '../view/product-delete.php';
   exit;
   break;
  case 'deleteProd':
   $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
   $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
      
    // delete the data in the database through the model
   $deleteOutcome = deleteProduct($invId);
   
   // Check and report the result
   if($deleteOutcome){
    $message = "<p class='messagesuccess'>$invName Product has been successfully deleted.</p>";
    $_SESSION['message']= $message;
    header('location: /backendprojects/phpprojects/acme/products/');
   exit;
   } else {
    $message = "<p class='messagefailure'>Error: sorry,  $invName Product has not been deleted. Please, try again.</p>";
    $_SESSION['message']= $message;
    header('location: /backendprojects/phpprojects/acme/products/');
    exit;
   }
   break;
  case 'categorydisplay':
   $categoryName = filter_input(INPUT_GET, 'categoryName', FILTER_SANITIZE_STRING);
   $products = getProductsByCategory($categoryName);
   if(!count($products)){
    $message = "<p>Sorry, no $categoryName products could be found.</p>";
    // the next line for testing
    // echo $message;
   } else {
    $prodDisplay = buildProductsDisplay($products);
    // the next line for testing 
    // echo $prodDisplay;
   }
   // the next line for testing
   // exit;
  include '../view/category.php';
   break;
  case 'productdisplay':
   $invId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
   $prodInfo = getProductInfo($invId);
   if(count($prodInfo) < 1){
    $message = "<p>Sorry, no $prodInfo[invName] product could be found.</p>";
    // the next line for testing
    // echo $message;
   } else {
    $productDisplay = buildProductDisplay($prodInfo);
    // the next line for testing 
    // echo $productDisplay;
    
    // Call function to return thumbnail images from database for the corresponding product and assign the returned array to the $thumbnailArray variable
  $thumbnailArray = getThumbnailImages($invId);
 // the next line for testing 
 //  print_r($thumbnailArray);
  
  // Call function to wrap the returned thumbnail images in HTML so they are ready to be viewed.
  $thumbnailDisplay = buildThumbnailImageDisplay($thumbnailArray);
  // the next line for testing
   // echo $thumbnailDisplay;
   }   
  include '../view/product-detail.php';
   break;
  case 'feature':
   $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
   $prodInfo = getProductInfo($invId);
   $featuredProdInfo = getFeaturedProductInfo();
   // echo var_dump($prodInfo);
   // echo var_dump($featuredProdInfo);
  
   if($featuredProdInfo) {
    // Code to begin setting the current featured product to an unfeatured status
    // $featuredProdInfo["invFeatured"] = NULL;
    // $invunsetFeatured = filter_var($featuredProdInfo["invFeatured"], FILTER_VALIDATE_BOOLEAN);
    // $newUnfeaturedProd = cancelCurrentFeaturedProd($invunsetFeatured);
    
    // Another option of code to begin setting the current featured product to an unfeatured status
    $newUnfeaturedProd = cancelCurrentFeaturedProd(); 
    }
     // Code to begin setting the current selected product to a featured status
    // $prodInfo["invFeatured"] = TRUE;
    // $invFeatured = filter_var($prodInfo["invFeatured"], FILTER_VALIDATE_BOOLEAN);
    // $newFeaturedProd = makeNewFeaturedProd($invId, $invFeatured);
    
    // Another option of code to begin setting the current selected product to a featured status
    $newFeaturedProd = makeNewFeaturedProd($invId);
    // the next two lines for testing
    // echo $newFeaturedProd;
    // echo $newUnfeaturedProd;
        
    if($newFeaturedProd || $newUnfeaturedProd || !$newUnfeaturedProd){
     $message = "<p class='messagesuccess'>Previously featured item: $featuredProdInfo[invName] was cleared.<br>New featured item: $prodInfo[invName] was set.</p>";
    $_SESSION['message']= $message;
    header('location: /backendprojects/phpprojects/acme/products/');
    exit;
    }
   break;
  default:
   $products = getProductBasics();
   if(count($products) > 0){
    $prodList = '<table>';
    $prodList .= '<thead>';
    $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>';
    $prodList .= '</thead>';
    $prodList .= '<tbody>';
    foreach ($products as $product) {
     $prodList .= "<tr><td>$product[invName]</td>";
     $prodList .= "<td><a class='tablelink' href='../products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
     $prodList .= "<td><a class='tablelink' href='../products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td>";
     $prodList .= "<td><a class='tablelink' href='../products?action=feature&id=$product[invId]' title='Click to feature'>Feature</a></td></tr>";
    }
    $prodList .= '</tbody></table>';
   } else {
    $message = '<p>Sorry, no products were returned.</p>';
   }   
    include '../view/product-management.php';
   break;
 }
 

