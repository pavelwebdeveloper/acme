<div id="upperheader">
<div>
 <a href="/phpprojects/acme/index.php" title="a link to Home page"><img id="logo" src="/phpprojects/acme/images/site/logo.gif" alt="Logo image"></a>
</div>
<div class='headerright'>
<?php
if(!isset($_SESSION['loggedin'])){
echo $greeting;
} else {
 $clientFirstname = $_SESSION['clientData']['clientFirstname'];
 setcookie('firstname', $clientFirstname, strtotime('-1 year'), '/'); 
  echo "<a class='linkright' href='/phpprojects/acme/accounts/index.php?action=loggedin' title='a link to the accounts Admin view'>Welcome " . $_SESSION['clientData']['clientFirstname'] . "</a><span>|</span>";
 }
?>
<?php if(isset($_SESSION['loggedin'])) {echo "<a class='linkright' href='/phpprojects/acme/accounts/index.php?action=Logout' title='a link to log out'>Logout</a>";} else { echo "<a class='linkright' href='/phpprojects/acme/accounts/index.php?action=login' title='a link to My Account page'>
<div class='headerright'> 
   <div><img id='folderimage' src='/phpprojects/acme/images/site/account.gif' alt='Folder image'></div>
   <div>My Account</div> 
</div>
</a>";} ?>
</div>
 </div>
<nav>
 <button id="smallmenu" onclick="toggleMenu()">&#9776; MENU</button>
   <?php
   if(isset($navList)){
echo $navList;
} else {
 echo "<ul id='primaryNav' class='hide'>
 <li><a id='home' href='' title='a link to Home page'>Home</a></li>
 <li><a href='' title='a link to Cannon page'>Cannon</a></li>
 <li><a href='' title='a link to Explosive page'>Explosive</a></li>
 <li><a href='' title='a link to Misc page'>Misc</a></li>
 <li><a href='' title='a link to Rocket page'>Rocket</a></li>
 <li><a href='' title='a link to Trap page'>Trap</a></li>
</ul>"; 
}
   ?>
  </nav>