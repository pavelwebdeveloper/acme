<?php if(isset($_SESSION['loggedin'])) ?>
<!DOCTYPE html>
<html lang="en-us">
 <head>
  <title>Acme Account Update</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../css/acmestyles.css" rel="stylesheet" media="screen">
  <link href="../css/normalize.css" rel="stylesheet" media="screen">
  <link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans%7cDelius+Swash+Caps" rel="stylesheet">
 </head>
 <body>
  <header>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/backendprojects/phpprojects/acme/common/header.php'; ?>
  </header>
  <main id="clientupdatepage">
   <h1>Account Update</h1>
   <p>You can use this form to update your name and email information.</p>
   
   
   <?php
    if (isset($accountmessage)) {
    echo $accountmessage;
   }
   ?>
   
   <form method="post" action="/backendprojects/phpprojects/acme/accounts/index.php">
    <fieldset>
     <label for="clientFirstname">First name</label>
     <input type="text" name="clientFirstname" id="clientFirstname" pattern="[A-Za-z]{2,}" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($clientInfo['clientFirstname'])) {echo "value='$clientInfo[clientFirstname]'"; } ?> required>
     <label for="clientLastname">Last name</label>
     <input type="text" name="clientLastname" id="clientLastname" pattern="[A-Za-z]{2,}" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($clientInfo['clientLastname'])) {echo "value='$clientInfo[clientLastname]'"; } ?> required>
     <label for="clientEmail">Email</label>
     <input type="email" name="clientEmail" id="clientEmail" placeholder="someone@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.]+\.[a-z]{2,}$" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($clientInfo['clientEmail'])) {echo "value='$clientInfo[clientEmail]'"; } ?> required>
     <input class="submitBtn" name="submit" type="submit" value="Update Account">
     <!-- Add the action name - value pair -->
     <input type="hidden" name="action" value="updateaccount">
     <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){echo $_SESSION['clientData']['clientId'];} ?>">
    </fieldset>
   </form>
   
   <h2>Change Password</h2>
   <p>You can use this form to update your password. Entering and submitting a new password in this field you will change the current password.</p>
   
   <?php
    if (isset($passwordmessage)) {
    echo $passwordmessage;
   }
   ?>
   
   <form method="post" action="/backendprojects/phpprojects/acme/accounts/index.php">
    <fieldset>
     <label id="labelpassword" for="clientPassword">New Password:</label>
     <span class="passworddescription">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, 1 lower case letter and 1 special character</span>
     <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
     <input class="submitBtn" name="submit" type="submit" value="Change Password">
     <!-- Add the action name - value pair -->
     <input type="hidden" name="action" value="passwordchange">
     <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])){echo $_SESSION['clientData']['clientId'];} ?>">
    </fieldset>
   </form>
   <p id="bottomline"></p>
  </main>
  <footer>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/backendprojects/phpprojects/acme/common/footer.php'; ?>
  </footer>
  <script src="../jsscript/hamburger.js"></script>
 </body>
</html>

