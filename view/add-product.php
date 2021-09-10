<?php 
if(!($_SESSION['clientData']['clientLevel'] > 1)) {
 header('Location: /phpprojects/acme/');
 exit;
}
 // Build a dynamic drop-down select list using the $categories array
 $catList .= '<select name="categoryId" id="categoryId">';
 $catList .= '<option disabled selected>Choose a category</option>';
 foreach ($categories as $category) {
 /*$catList .= "<option value=".urlencode($category['categoryId']).">".urlencode($category['categoryName'])."</option>";*/
  $catList .= "<option value='$category[categoryId]'";
  if(isset($categoryId)) {
   
   if($category['categoryId'] === $categoryId){
    $catList .= ' selected ';
   }
  }
  
  $catList .= ">$category[categoryName]</option>";
 }
 $catList .= '</select>';
?><!DOCTYPE html>
<html lang="en-us">
 <head>
  <title>Add Product</title>
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
   <h1>Add a Product</h1>
   <p>Add a new product below. All fields are required.</p>
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
     <label>Product Name</label>
     <input type="text" name="invName" id="invName" pattern="[A-za-z\s]{3,}" <?php if(empty($checkinvName)){echo "value=''";} else {echo "value='$invName'";} ?> required>
     <label>Product Description</label>
     <textarea name="invDescription" id="invDescription" rows="10" cols="43" placeholder="Please, describe the new product." required><?php if(isset($invDescription)) {echo "$invDescription";} ?></textarea>
     <label>Product Image (path to image)</label>
     <input type="text" name="invImage" id="invImage" pattern="[a-z-.\/]{3,}" <?php if(empty($checkinvImage)){echo "value=''";} else {echo "value='$invImage'";} ?> required>
     <label>Product Thumbnail (path to thumbnail)</label>
     <input type="text" name="invThumbnail" id="invThumbnail" pattern="[a-z-.\/]{3,}" <?php if(empty($checkinvThumbnail)){echo "value=''";} else {echo "value='$invThumbnail'";} ?> required>
     <label class="number">Product Price</label>
     <input type="number" name="invPrice" id="invPrice" <?php if(isset($invPrice)){echo "value='$invPrice'";} ?>  required>
     <label class="number">Product Stock</label>
     <input type="number" name="invStock" id="invStock" <?php if(isset($invStock)){echo "value='$invStock'";} ?> required>
     <label class="number">Product Size</label>
     <input type="number" name="invSize" id="invSize" <?php if(isset($invSize)){echo "value='$invSize'";} ?> required>
     <label class="number">Product Weight</label>
     <input type="number" name="invWeight" id="invWeight" <?php if(isset($invWeight)){echo "value='$invWeight'";} ?> required>
     <label>Product Location</label>
     <input type="text" name="invLocation" id="invLocation" pattern="[A-Za-z-\,s]{3,}" <?php if(empty($checkinvLocation)){echo "value=''";} else {echo "value='$invLocation'";} ?> required>
     <label>Product Vendor</label>
     <input type="text" name="invVendor" id="invVendor" pattern="[A-Za-z-\s]{3,}" <?php if(empty($checkinvVendor)){echo "value=''";} else {echo "value='$invVendor'";} ?> required>
     <label>Product Style</label>
     <input type="text" name="invStyle" id="invStyle" pattern="[A-Za-z]{3,}" <?php if(empty($checkinvStyle)){echo "value=''";} else {echo "value='$invStyle'";} ?> required>
     <input class="submitBtn" type="submit" value="Add Product">
     <!-- Add the action name - value pair -->
     <input type="hidden" name="action" value="newproduct">
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
