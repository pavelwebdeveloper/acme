<?php 
if (!($_SESSION['clientData']['clientLevel'] > 1)) {
 header('location: /phpprojects/acme/'); 
 exit; 
}
if (isset($_SESSION['message'])){
 $message = $_SESSION['message'];
}
 ?>
<!DOCTYPE html>
<html lang="en-us">
 <head>
  <title>Product Management</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../css/acmestyles.css" rel="stylesheet" media="screen">
  <link href="../css/normalize.css" rel="stylesheet" media="screen">
  <link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans%7cDelius+Swash+Caps" rel="stylesheet">
 </head>
 <body>
  <header>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/phpprojects/acme/common/header.php'; ?>
  </header>
  <main class="productpages">
   <h1>Product Management</h1>
   <p>Welcome to the product management page. Please, choose an option below:</p>
   <ul>
    <li><a href="../products/index.php?action=addcategory">Add a New Category</a></li>
    <li><a href="../products/index.php?action=addproduct">Add a New Product</a></li>
    <li><a href="../uploads/index.php" target="_blank">Manage Images</a></li>
   </ul>
   <?php
   if(isset($message)) {
    echo $message;
   } if (isset($prodList)) {
    echo $prodList;
   }
   ?>
   <p id="bottomline"></p>
  </main>
  <footer>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/phpprojects/acme/common/footer.php'; ?>
  </footer>
  <script src="../jsscript/hamburger.js"></script>
 </body>
</html>
<?php unset($_SESSION['message']); ?>

