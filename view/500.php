<!DOCTYPE html>
<html lang="en-us">
 <head>
  <title>Server Error</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../css/acmestyles.css" rel="stylesheet" media="screen">
  <link href="../css/normalize.css" rel="stylesheet" media="screen">
  <link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans%7cDelius+Swash+Caps" rel="stylesheet">
 </head>
 <body>
  <header>
   <?php
   $greeting = "";
 include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/phpprojects/acme/common/header.php'; ?>
  </header>
  <main>
   <h1 id="errorh">Server Error</h1>
   <br>
   <p id="errorp">Sorry, the connection has failed.</p>
   <p id="bottomline"></p>
  </main>
  <footer>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/phpprojects/acme/common/footer.php'; ?>
  </footer>
  <script src="../jsscript/hamburger.js"></script>
 </body>
</html>

