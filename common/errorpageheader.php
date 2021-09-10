<div id="upperheader">
<div>
 <a href="/phpprojects/acme/index.php" title="a link to Home page"><img id="logo" src="/phpprojects/acme/images/site/logo.gif" alt="Logo image"></a>
</div>
<div class='headerright'>
<?php if(isset($_SESSION['loggedin'])) {echo "<a class='linkright' href='/phpprojects/acme/accounts/index.php?action=Logout' title='a link to log out'>Logout</a>";} else { echo "<a class='linkright' href='/backendprojects/phpprojects/acme/accounts/index.php?action=login' title='a link to My Account page'>
<div class='headerright'> 
   <div><img id='folderimage' src='/phpprojects/acme/images/site/account.gif' alt='Folder image'></div>
   <div>My Account</div> 
</div>
</a>";} ?>
</div>
 </div>

