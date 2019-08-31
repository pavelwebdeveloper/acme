<?php 
if(!($_SESSION['clientData']['clientLevel'] > 1)) {
 header('location: /backendprojects/phpprojects/acme/');
 exit;
}
?><!DOCTYPE html>
<html lang="en-us">
 <head>
  <title><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName] "; } ?> | Acme, Inc.</title>
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
   <h1><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName] "; } ?></h1>
   <p>Confirm the <?php if(isset($prodInfo['invName'])){ echo "$prodInfo[invName] "; } ?> Product Deletion. The delete is permanent and cannot be undone.</p>
   <?php
   if (isset($message)) {
    echo $message;
   }
   ?>
   <form action="/backendprojects/phpprojects/acme/products/" method="post">
    <fieldset>     
     <label for="invName">Product Name</label>
     <input type="text" name="invName" id="invName"  <?php if(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; } ?> readonly>
     <label for="invDescription">Product Description</label>
     <textarea name="invDescription" id="invDescription" rows="10" cols="43" readonly><?php if(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; } ?></textarea>
     
     <input class="submitBtn" type="submit" name="submit" value="Delete Product">
     
     <!-- Add the action name - value pair -->
     <input type="hidden" name="action" value="deleteProd">
     <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId']; } ?>">
     
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
