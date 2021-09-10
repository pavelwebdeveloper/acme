<?php 
if(!($_SESSION['clientData']['clientLevel'] > 1)) {
 header('Location: /phpprojects/acme/');
 exit;
}
 // Build a dynamic drop-down select list using the $categories array
 $catList .= '<select name="categoryId" id="categoryId">';
 $catList .= '<option disabled>Choose a category</option>';
 foreach ($categories as $category) {
 /*$catList .= "<option value=".urlencode($category['categoryId']).">".urlencode($category['categoryName'])."</option>";*/
  $catList .= "<option value='$category[categoryId]'";
  if(isset($categoryId)) {
   
   if($category['categoryId'] === $categoryId){
    $catList .= ' selected ';
   }
  } elseif(isset($prodInfo['categoryId'])){
  if($category['categoryId'] === $prodInfo['categoryId']){
   $catList .= ' selected ';
  }
}
  $catList .= ">$category[categoryName]</option>";
 }
 $catList .= '</select>';
?><!DOCTYPE html>
<html lang="en-us">
 <head>
  <title><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] "; } elseif(isset($invName)) { echo $invName; } ?> | Acme, Inc.</title>
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
   <h1><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] "; } elseif(isset($invName)) { echo $invName; } ?></h1>
   <p>Modify the product below.</p>
   <?php
   if (isset($message)) {
    echo $message;
   }
   ?>
   <form action="/phpprojects/acme/products/index.php" method="post">
    <fieldset>
     <label>Category</label>
     <?php
   echo $catList;
   ?>
     <label for="invName">Product Name</label>
     <input type="text" name="invName" id="invName" pattern="[A-za-z\s]{3,}" <?php if(isset($invName)){ echo "value='$invName'"; } elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; } ?> required>
     <label for="invDescription">Product Description</label>
     <textarea name="invDescription" id="invDescription" rows="10" cols="43" placeholder="Please, describe the new product." required><?php if(isset($invDescription)) {echo "$invDescription";} elseif(isset($prodInfo['invDescription'])) {echo $prodInfo['invDescription']; } ?></textarea>
     <label>Product Image (path to image)</label>
     <input type="text" name="invImage" id="invImage" pattern="[a-z0-9-.\_/]{3,}" <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($prodInfo['invImage'])) {echo "value='$prodInfo[invImage]'"; } ?> required>
     <label>Product Thumbnail (path to thumbnail)</label>
     <input type="text" name="invThumbnail" id="invThumbnail" pattern="[a-z0-9-.\_/]{3,}" <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($prodInfo['invThumbnail'])) {echo "value='$prodInfo[invThumbnail]'"; } ?> required>
     <label class="number">Product Price</label>
     <input type="number" name="invPrice" id="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($prodInfo['invPrice'])) {echo "value='$prodInfo[invPrice]'"; } ?>  required>
     <label class="number">Product Stock</label>
     <input type="number" name="invStock" id="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($prodInfo['invStock'])) {echo "value='$prodInfo[invStock]'"; } ?> required>
     <label class="number">Product Size</label>
     <input type="number" name="invSize" id="invSize" <?php if(isset($invSize)){echo "value='$invSize'";} elseif(isset($prodInfo['invSize'])) {echo "value='$prodInfo[invSize]'"; } ?> required>
     <label class="number">Product Weight</label>
     <input type="number" name="invWeight" id="invWeight" <?php if(isset($invWeight)){echo "value='$invWeight'";} elseif(isset($prodInfo['invWeight'])) {echo "value='$prodInfo[invWeight]'"; } ?> required>
     <label>Product Location</label>
     <input type="text" name="invLocation" id="invLocation" pattern="[A-Za-z-\s,]{3,}" <?php if(isset($invLocation)){ echo "value='$invLocation'"; } elseif(isset($prodInfo['invLocation'])) {echo "value='$prodInfo[invLocation]'"; } ?> required>
     <label>Product Vendor</label>
     <input type="text" name="invVendor" id="invVendor" pattern="[A-Za-z-\s\&]{3,}" <?php if(isset($invVendor)){ echo "value='$invVendor'"; } elseif(isset($prodInfo['invVendor'])) {echo "value='$prodInfo[invVendor]'"; } ?> required>
     <label>Product Style</label>
     <input type="text" name="invStyle" id="invStyle" pattern="[A-Za-z-\s]{3,}" <?php if(isset($invStyle)){ echo "value='$invStyle'"; } elseif(isset($prodInfo['invStyle'])) {echo "value='$prodInfo[invStyle]'"; } ?> required>
     <input class="submitBtn" type="submit" name="submit" value="Update Product">
     <!-- Add the action name - value pair -->
     <input type="hidden" name="action" value="updateProd">
     <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId']; } elseif(isset($invId)) {echo $invId; } ?>">
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
