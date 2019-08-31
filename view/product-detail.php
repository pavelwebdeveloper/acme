<!DOCTYPE html>
<html lang="en-us">
 <head>
  <title><?php echo $prodInfo['invName']; ?> Product. | Acme, Inc. </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../css/acmestyles.css" rel="stylesheet" media="screen">
  <link href="../css/normalize.css" rel="stylesheet" media="screen">
  <link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans%7cDelius+Swash+Caps" rel="stylesheet">
 </head>
 <body>
  <header>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/backendprojects/phpprojects/acme/common/header.php'; ?>
  </header>
  <main class="productpages">
   <h1><?php echo $prodInfo['invName']; ?></h1>
   <?php
   if(isset($message)){
   echo $message;
   }
   ?>
   <?php
   if(isset($productDisplay)){
    echo $productDisplay;
   }
   ?>
   <hr>
   <h2>Product thumbnails</h2>
   <?php
    if(isset($thumbnailDisplay)){
    echo $thumbnailDisplay;
   }
   ?>
   <p id="bottomline"></p>
  </main>
  <footer>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/backendprojects/phpprojects/acme/common/footer.php'; ?>
  </footer>
  <script src="../jsscript/hamburger.js"></script>
 </body>
</html>


