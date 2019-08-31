<!DOCTYPE html>
<html lang="en-us">
 <head>
  <title>Acme login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../css/acmestyles.css" rel="stylesheet" media="screen">
  <link href="../css/normalize.css" rel="stylesheet" media="screen">
  <link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans%7cDelius+Swash+Caps" rel="stylesheet">
 </head>
 <body>
  <header>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/backendprojects/phpprojects/acme/common/header.php'; ?>
  </header>
  <main class="otherpages">
   <h1>Acme Login</h1>
   <?php
   if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
   }
   ?>
   <form action="/backendprojects/phpprojects/acme/accounts/index.php" method="post">
    <fieldset>
     <label for="clientEmail">Email</label>
     <input type="email" name="clientEmail" id="clientEmail" placeholder="someone@gmail.com" pattern="[a-z0-9\._%+-]+@[a-z0-9.]+\.[a-z]{2,}$"<?php if(isset($clientEmail)){echo "value='$clientEmail'";}?> required>
     <label for="clientPassword">Password</label>
     <span class="passworddescription">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, 1 lower case letter and 1 special character</span>
     <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
     <input class="submitBtn" type="submit" value="Login">
     <!-- Add the action name - value pair -->
     <input type="hidden" name="action" value="Login">
     <p id="login">Not a member?</p>
     <a id="aregister" href="../accounts/index.php?action=registration" title="a link to create an account">Create an Account</a>
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

