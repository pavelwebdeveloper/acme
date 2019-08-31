<!DOCTYPE html>
<html lang="en-us">
 <head>
  <title>Acme Home page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/acmestyles.css" rel="stylesheet" media="screen">
  <link href="../css/normalize.css" rel="stylesheet" media="screen">
  <link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans%7cDelius+Swash+Caps" rel="stylesheet">
  <script
                src="https://code.jquery.com/jquery-3.3.1.js"
                integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
                crossorigin="anonymous"></script>
         <script>
          $(function() {
          $('#home').addClass('active');
          });
        </script>
 </head>
 <body>
  <header>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/backendprojects/phpprojects/acme/common/header.php'; ?>
  </header>
  <main>
   <h1>Welcome to Acme!</h1>
   <div id="mainpicture">
    <?php 
    if (isset($featuredProduct)) {
    echo $featuredProduct;
    } else {
     echo $defaultProduct;
    }
    ?>    
   </div>
   <div id="flex">
    <article id="flexleft">
     <h3>Featured Recipes</h3>
     <div id="grid">
      <figure>
       <div><img src="/backendprojects/phpprojects/acme/images/recipes/bbqsand.jpg" alt="Pulled Roadrunner BBQ"></div>
       <a href="" title="A link to the recipe for Pulled Roadrunner BBQ"><p class="figcaption">Pulled Roadrunner BBQ</p></a>
            </figure>
            <figure>
             <div><img src="/backendprojects/phpprojects/acme/images/recipes/potpie.jpg" alt="Roadrunner Pot Pie"></div>
             <a href="" title="A link to the recipe for Roadrunner Pot Pie"><p class="figcaption">Roadrunner Pot Pie</p></a>
            </figure>
            <figure>
     <div><img src="/backendprojects/phpprojects/acme/images/recipes/soup.jpg" alt="Roadrunner Soup"></div>
     <a href="" title="A link to the recipe for Roadrunner Soup"><p class="figcaption">Roadrunner Soup</p></a>
            </figure>
            <figure>
             <div><img src="/backendprojects/phpprojects/acme/images/recipes/taco.jpg" alt="Roadrunner Tacos"></div>
             <a href="" title="A link to the recipe for Roadrunner Tacos"><p class="figcaption">Roadrunner Tacos</p></a>
            </figure>
     </div>
    </article>
   </div>
   <p id="bottomline"></p>
  </main>
  <footer>
   <?php include $_SERVER[ 'DOCUMENT_ROOT' ]  .  '/backendprojects/phpprojects/acme/common/footer.php'; ?>
  </footer>
  <script src="jsscript/hamburger.js"></script>
 </body>
</html>
