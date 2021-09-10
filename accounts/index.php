<?php

/*This is the Accounts Controller */

// Create or access a Session
session_start();

 // Get the database connection file
 require_once '../library/connections.php';
 // Get the acme model for use as needed
 require_once '../model/acme-model.php';
 // Get the accounts model
 require_once '../model/accounts-model.php';
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
 
 // Get the value from the action name - value pair
 $action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 
 switch ($action){ 
  // Code to deliver the views
  case 'login':
    include '../view/login.php';
   break;
  case 'registration':
    include '../view/registration.php';
   break;
  case 'Login':
   // Filter and store the data
   $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
   $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
   
   // validate the email variable and password variable using the custom functions from functions.php
   $clientEmail = checkEmail($clientEmail);
   $checkPassword = checkPassword($clientPassword);
   
   // Check for missing data
   if(empty($clientEmail) || empty($checkPassword)){
    $_SESSION['message'] = "<p>Please, provide a valid email address and password.</p>";
    include '../view/login.php';
    /*header('Location: /acme/accounts/?action=login');
    $message = '<p>Please, provide a valid email address and password.</p>';
    include '../view/login.php';*/
    exit;
   }
   
   /*else {
    echo "Logged in successfully !!!!!!!!!!!!!";
   }*/
   
   // A valid password exists, proceed with the login process
   // Query the client data based on the email address
   $clientData = getClient($clientEmail);
   // Compare the password just submitted against
   // the hashed password for the matching client
   $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
   // If the hashes don't match create an error
   // and return to the login view
   if(!$hashCheck) {
    $_SESSION['message'] = "<p>Please, check your password and try again.</p>";
    include '../view/login.php';
    /*header('Location: /acme/accounts/?action=Login');
   $message = '<p>Please check your password and try again.</p>';
    include '../view/login.php';*/
    exit;
   }
   // A valid user exists, log them in
   $_SESSION['loggedin'] = TRUE;
   // Remove the password from the array
   // the array_pop function removes the last
   // element from an array
   array_pop($clientData);
   // Store the array into the session
   $_SESSION['clientData'] = $clientData;
   $_SESSION['message'] = '';
   // Send them to the admin view
   include '../view/admin.php';
   exit;
   
   
   
   
   break;
  case 'register':
   // Filter and store the data
   $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
   $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
   $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
   $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
   
   // validate the email variable and password variable using the custom functions from functions.php
   $clientEmail = checkEmail($clientEmail);
   $checkPassword = checkPassword($clientPassword);
   
   //  checking for an existing email address
   $alreadyexistingEmail = checkforExistingemail($clientEmail);
   // Check for existing email address in the table
   if($alreadyexistingEmail) {
    $_SESSION['message'] = "<p>Sorry $clientFirstname. The email address already exists. Do you want to login instead?</p>";
    include '../view/login.php';
   exit;
   }
   
   // Check for missing data
   if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
    $message = '<p>Please, provide information correctly for all form fields.</p>';
    include '../view/registration.php';
    exit;
   }
   
   // Hash the checked password
   $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
   
   // Send the data to the model
   $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
   
   // Check and report the result and create the cookie when the individual registers with the site
   if($regOutcome === 1){
    setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
    $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please, use your email and password to login.</p>";
    header('Location: /phpprojects/acme/accounts/?action=login');
   exit;
   } else {
    $message = "<p>Sorry $clientFirstname, but the registration failed. Please, try again.</p>";
            include '../view/registration.php';
    exit;
   }
   break;
  case 'updateview':
    $clientId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
   $clientInfo = getClientinfo($clientId);
   if(count($clientInfo) < 1){
    $message = 'Sorry, no client information could be found.';
   }
   include '../view/client-update.php';
   break;
  case 'updateaccount':
   // Filter and store the data
   $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
   $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
   $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
   $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
   
   // validate the email variable using the custom functions from functions.php
   $clientEmail = checkEmail($clientEmail);
   
   // Check if the email address is different than the one in the session
   if($clientEmail != $_SESSION['clientData']['clientEmail']) {
     //  checking for an existing email address
   $alreadyexistingEmail = checkforExistingemail($clientEmail);
   // Check for existing email address in the table
   if($alreadyexistingEmail) {
    $_SESSION['message'] = "<p>Sorry $clientFirstname. Such an email address already exists.</p>";
    include '../view/client-update.php';
   exit;
   }
   }
     
   
   
   // Check for missing data
   if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
    $accountmessage = '<p class="message">Please, provide information correctly for all form fields.</p>';
    include '../view/client-update.php';
    exit;
   }
  $updateAccountoutcome = updateClientaccount($clientFirstname, $clientLastname, $clientEmail, $clientId);
   
   // Check and report the result
   if($updateAccountoutcome === 1){
    // Query the client data based on the client ID
   $clientUpdateddata = getClientupdateddata($clientId);
   // Store the array into the session
   $_SESSION['clientData'] = $clientUpdateddata;
   // setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
    $_SESSION['message'] = "<p class='messagesuccess'>$clientFirstname,  your account information has been successfully updated.</p>";
    include '../view/admin.php';
   exit;
   } else {
    $message = "<p class='messagefailure'>Sorry $clientFirstname, but the account update failed. Please, try again.</p>";
            include '../view/admin.php';
    exit;
   }
   break;
  case 'passwordchange':
    // Filter and store the password data
   $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
   $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
   
   // validate the password variable using a custom function from functions.php
   $checkPassword = checkPassword($clientPassword);
   
   // Check for missing data
   if(empty($checkPassword)){
    $clientInfo = getClientinfo($clientId);
    $passwordmessage = '<p class="messagefailure">Please, provide the new password information correctly.</p>';
    include '../view/client-update.php';
    exit;
   }
   
   // Hash the checked password
   $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
   
   // Send the data to the model
   $passwordUpdateoutcome = updatePassword($hashedPassword, $clientId);
   
   // Check and report the result
   if($passwordUpdateoutcome){
    $_SESSION['message'] = "<p class='messagesuccess'>".$_SESSION['clientData']['clientFirstname'].", your password has been successfully updated.</p>";
    include '../view/admin.php';
   exit;
   } else {
    $_SESSION['message'] = "<p>Sorry $clientFirstname, but the password update failed. Please, try again.</p>";
            include '../view/admin.php';
    exit;
   }
   break;
  case 'loggedin':
   include '../view/admin.php';
    exit;
   break;
  case 'Logout':
   $_SESSION = [];
   session_destroy();
   header('Location: /phpprojects/acme/index.php');
   break;
  default:
   include '../view/admin.php';
   exit;
 }
 


 
 