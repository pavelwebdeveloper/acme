<?php 
if(!($_SESSION['clientData']['clientLevel'] > 1)) {
 header('Location: /backendprojects/phpprojects/acme/');
exit; 
}
?>
<!DOCTYPE html>
<html lang="en-us">
 <head>
  <title>Add Category</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../css/acmestyles.css" rel="stylesheet" media="screen">
  <link href="../css/normalize.css" rel="stylesheet" media="screen">
  <link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans%7cDelius+Swash+Caps" rel="stylesheet">
 </head>
 <body>
  <header>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/phpprojects/acme/common/header.php'; ?>
  </header>
  <main id="addcategorypage">
   <h1>Add Category</h1>
   <p>Add a new category of products below.</p>
   <?php
   if (isset($message)) {
    echo $message;
   }
   ?>
   <form action="/phpprojects/acme/products/index.php" method="post">
    <fieldset>
     <label>New Category Name</label>
     <input type="text" name="categoryName" id="categoryName" pattern="[A-Z][a-z]{2,}" required>
     <input class="submitBtn" type="submit" value="Add Category">
     <!-- Add the action name - value pair -->
     <input type="hidden" name="action" value="newcategory">
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
