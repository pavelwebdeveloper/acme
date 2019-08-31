<?php if(!($_SESSION['loggedin']) && !($_SESSION['clientData']['clientLevel'] > 1)){header('Location: /backendprojects/phpprojects/acme/index.php');}
if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
}
?><!DOCTYPE html>
<html lang="en-us">
 <head>
  <title>Image Management</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../css/acmestyles.css" rel="stylesheet" media="screen">
  <link href="../css/normalize.css" rel="stylesheet" media="screen">
  <link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans%7cDelius+Swash+Caps" rel="stylesheet">
 </head>
 <body>
  <header>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/backendprojects/phpprojects/acme/common/header.php'; ?>
  </header>
  <main id="imageadminpage">
   <h1>Image Management</h1>
   <p>Welcome to the image management page. Please, choose one of the options presented below.</p>
   <h2>Please, add New Product Image(s)</h2>
<?php
 if (isset($message)) {
  echo $message;
 } ?>

<form action="/backendprojects/phpprojects/acme/uploads/" method="post" enctype="multipart/form-data">
 <label for="invId">Product</label>
 <?php echo $prodSelect; ?><br><br>
 <label for="uploadfile">Upload Image</label>
 <input id="uploadfile" type="file" name="file1"><br>
 <input type="submit" class="submitBtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>
<hr>
<h2>Existing Images</h2>
<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>
   <p id="bottomline"></p>
  </main>
  <footer>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/backendprojects/phpprojects/acme/common/footer.php'; ?>
  </footer>
  <script src="../jsscript/hamburger.js"></script>
 </body>
</html><?phpunset($_SESSION['message']);?>


