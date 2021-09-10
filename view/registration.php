<!DOCTYPE html>
<html lang="en-us">
 <head>
  <title>Acme Registration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../css/acmestyles.css" rel="stylesheet" media="screen">
  <link href="../css/normalize.css" rel="stylesheet" media="screen">
  <link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans%7cDelius+Swash+Caps" rel="stylesheet">
 </head>
 <body>
  <header>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/phpprojects/acme/common/header.php'; ?>
  </header>
  <main class="otherpages">
   <h1>Acme Registration</h1>
   
   <?php
   if (isset($message)) {
    echo $message;
   }
   ?>
   
   <form method="post" action="/phpprojects/acme/accounts/index.php">
    <fieldset>
     <p id="rp">All fields are required.</p>
     <label for="clientFirstname">First name</label>
     <input type="text" name="clientFirstname" id="clientFirstname" pattern="[A-Za-z]{2,}" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} ?>  required>
     <label for="clientLastname">Last name</label>
     <input type="text" name="clientLastname" id="clientLastname" pattern="[A-Za-z]{2,}" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?>  required>
     <label for="clientEmail">Email</label>
     <input type="email" name="clientEmail" id="clientEmail" placeholder="someone@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.]+\.[a-z]{2,}$" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} ?> required>
     <label id="labelpassword" for="clientPassword">Password:</label>
     <span class="passworddescription">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, 1 lower case letter and 1 special character</span>
     <input type="password" name="clientPassword" id="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
     <input class="submitBtn" name="submit" type="submit" value="Register">
     <!-- Add the action name - value pair -->
     <input type="hidden" name="action" value="register">
    </fieldset>
   </form>
   <p id="bottomline"></p>
  </main>
  <footer>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/phpprojects/acme/common/footer.php'; ?>
  </footer>
  <script src="../jsscript/hamburger.js"></script>
 </body>
</html>

