<ul id='nav'>
<li><a href='index.php'>Home</a></li>
<li id='center'>
<a href="#">Users</a>
<div class="submenu">
<ul style='background:rgba(0, 0, 0, 0.4)'>
<?php 
if (!isset($_SESSION['uid'])) {
?>
<li><a href='login.php'>Log in</a></li>
<li><a href='create.php'>Create account</a></li>
<?php
}
else {
?>
<li><a href='modif.php'>Modify account</a></li>
<li><a href='login.php?action=logout'>Log out</a></li>
<?php
}
?>
</ul>
</div>
</li>
<li><a href='game.php'>Play</a></li>
</ul>
