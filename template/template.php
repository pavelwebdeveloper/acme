<!DOCTYPE html>
<html lang="en-us">
 <head>
  <title>Acme template</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/acme/css/small.css" rel="stylesheet" media="screen">
  <link href="/acme/css/medium.css" rel="stylesheet" media="screen">
  <link href="/acme/css/large.css" rel="stylesheet" media="screen">
  <link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans%7cDelius+Swash+Caps" rel="stylesheet">
 </head>
 <body>
  <header>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/acme/common/header.php'; ?>
  </header>
  <nav>
   <?php
   /* modularization code for the main navigation menu
   include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/acme/common/nav.php'
   */
   echo $navList;
   ?>
  </nav>
  <main class="templatehomepages">
   <h1>Content Title Here</h1>
   <p id="bottomline"></p>
  </main>
  <footer>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/acme/common/footer.php'; ?>
  </footer>
 </body>
</html>


