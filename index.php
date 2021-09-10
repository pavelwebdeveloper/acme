<?php

/* This is the Acme Controller*/

// Create or access a Session
session_start();

 // Get the database connection file
 require_once 'library/connections.php';
 // Get the acme model for use as needed
 require_once 'model/acme-model.php';
 // Get the products model
 require_once 'model/products-model.php';
  // Get the functions library
 require_once 'library/functions.php';
 
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
 
 $action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 
 switch ($action){  
  case 'something':
   
   break;
  default:
   $featuredProdInfo = getFeaturedProductInfo();
   $featuredProduct = "<img id='featuredproduct' src='$featuredProdInfo[invImage]' alt='Image of $featuredProdInfo[invName] Featured Product'><ul id='upperlist'><li>$featuredProdInfo[invDescription]</li>
     <li><a href='/phpprojects/acme/' title='Add to cart button'><img id='actionbtn' alt='Add to cart button' src='/phpprojects/acme/images/site/iwantit.gif'></a></li>
    </ul>";
   $defaultProdInfo = getDefaultProdInfo();
   $defaultProduct = "<img id='featuredproduct' src='$defaultProdInfo[invImage]' alt='Image of $defaultProdInfo[invName] Featured Product'><ul id='upperlist'><li>$defaultProdInfo[invDescription]</li>
     <li><a href='/phpprojects/acme/' title='Add to cart button'><img id='actionbtn' alt='Add to cart button' src='/phpprojects/acme/images/site/iwantit.gif'></a></li>
    </ul>";
  include 'view/home.php';
 }
 


 
 