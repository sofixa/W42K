<?php
$name = "W40k";

?>
<script type="text/javascript">
var g_board = "";
var g_x = "";
var g_name = "";
var g_y = "";
var g_dir = "";
var g_height = "";
var g_width = "";
var g_sid = "";
var g_health = "";
var g_power = "";
var g_speed = "";
var g_armor = "";
var g_weapons = "";
var g_maneuver ="";
var g_uid = <?php 
if (isset($_SESSION['uid']))
	echo $_SESSION['uid'];
else
	echo '""';
?>;
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="includes/scripts.js"></script>
<script type="text/javascript" src="includes/board.js"> </script>
<?php 
if ($_SERVER['PHP_SELF'] != '/displayGame.php') {
	echo '
	<link rel="stylesheet" type="text/css" href="includes/struct.css" />
	<link rel="stylesheet" type="text/css" href="includes/style.css" />
	';
}
?>
