<?php if(!($_SESSION['loggedin'])){header('Location: /backendprojects/phpprojects/acme/index.php');}?><!DOCTYPE html>
<html lang="en-us">
 <head>
  <title>Acme admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../css/acmestyles.css" rel="stylesheet" media="screen">
  <link href="../css/normalize.css" rel="stylesheet" media="screen">
  <link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans%7cDelius+Swash+Caps" rel="stylesheet">
 </head>
 <body>
  <header>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/backendprojects/phpprojects/acme/common/header.php'; ?>
  </header>
  <main class="templatehomepages">
   <?php 
   echo "<h1 id='username'>".$_SESSION['clientData']['clientFirstname']." ".$_SESSION['clientData']['clientLastname']."</h1>"
           ."<p>You are logged in</p>";
           if(isset($_SESSION['message'])) {echo $_SESSION['message']; }
   echo  "<ul id='adminlist'><li>First Name: ".$_SESSION['clientData']['clientFirstname']."</li>"
           ."<li>Last Name: ".$_SESSION['clientData']['clientLastname']."</li>"
           ."<li>Email: ".$_SESSION['clientData']['clientEmail']."</li>"
           ."</ul>"
           ."<a class='adminlink' href='../accounts/index.php?action=updateview&id=".urlencode($_SESSION['clientData']['clientId'])."'>Update account information</a>";
   if($_SESSION['clientData']['clientLevel'] > 1) {echo "<h2>Administrative actions</h2><p>Use the link below to manage products.</p><a class='adminlink' href='/backendprojects/phpprojects/acme/products/index.php'>Products</a>";}
   
   ?>
   <p id="bottomline"></p>
  </main>
  <footer>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/backendprojects/phpprojects/acme/common/footer.php'; ?>
  </footer>
  <script src="../jsscript/hamburger.js"></script>
 </body>
</html>

