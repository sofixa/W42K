<?php
function __autoload($name) {
    require_once("includes/classes/ships/".$name.".class.php");
}
if (file_exists("includes/conf.php"))
    include_once("includes/conf.php");
else
    header('Location: install.php');
include_once("includes/includes.php");
if (!isset($_SESSION['gid']))
	header('Location: game.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Homepage <?php echo $name; ?></title>
	<style>
	#controls {
		width:500px;
		height:130px;
		border-radius:5px;
		border-style:groove;
		border-color:gray;
		-webkit-padding-start: 0px;
		display: none;
		font-family: Arial;
		color:white;
	}

	#center {
		border-left:2px groove white;
		border-right:2px groove white;
	}
	#nav li {
		display:inline;
	}
	#nav a {
		color:white;
		text-decoration:none;
		display:inline-block;
		margin:0 20px;
		
	}
	body {
		background:black url('images/bg.jpg') bottom right no-repeat fixed;
	}
	#structure {
		max-width:1498px;
		min-width:1498px;
		height:998px;
		margin-left:100px;
		margin-right:100px;
		border-style:groove;
		border-color:gray;
		border-width:5px;
		border-radius:15px;
	}
	#progressbar {
		width: 200px;
		height: 20px;
		margin-top: 5px;
		z-index: 0;
	}
	#toolbar {
		padding: 4px;
		display: inline-block;
	}
	#divBar1 {
		width: 50%;
		overflow:hidden;
		display:inline-block;
		float: left;
	}
	#divBar2 {
		width:20%;
		float:right;
	}
	#divBar3 {
		width:30%;
		float:right;
		text-align: right;
	}

	</style>
<?php
/*
<script>
$(function() {
	alert(document.getElementById("shealth").innerHTML);
	$( "#progressbar" ).progressbar({
			      value: document.getElementById("shealth").innerHTML
					      });
		  });
 </script>
 */
?>
<script>
$(function() { $( "#left" ).button({ text: false, icons: { primary: "ui-icon-circle-triangle-w" } });
		$( "#forward" ).button({ text: false, icons: { primary: "ui-icon-circle-triangle-n" } });
		$( "#right" ).button({ text: false, icons: { primary: "ui-icon-circle-triangle-e" } })
		$( "#fire" ).button({ text: false, icons: { primary: "ui-icon-eject" } });});

</script>
</head>
<body>
<center>
<img src='images/warhammer-40000-logo.png' width=200px/>
<div id='structure'>
<canvas id="my_canvas" width="1500" height="1000">
You suck
</canvas>
</div>
<br \>
<ul id='controls' > <br />
<div id="divBar1">
<div id="progressbar"> </div>
<div id="sname" style="font-size:22px"></div>
<div id="toolbar" class="ui-widget-header ui-corner-all">
<button id="left" onclick="moveLeft(<?php echo $_SESSION['gid']; ?>);"></button>
  <button id="forward" onclick="moveForward(<?php echo $_SESSION['gid']; ?>);"></button>
  <button id="right" onclick="moveRight(<?php echo $_SESSION['gid']; ?>);"></button>
  <button id="fire" ></button>
</div>
</div> <br />
<div id="divBar2">
<div id="spower"></div>
<div id="sarmor"></div>
<div id="sweapons"></div>
<div id="shealth"></div>
</div>
<div id="divbar3">
Power : <br />
Armor : <br />
Weapon : <br />
Life: <br />
</div>
</center>
</ul>
<script>
	window.selectedShip = 0;
	drawBoard(<?php echo $_SESSION['gid'].", ".$_SESSION['uid']; ?>)
</script>
</body>
</html>
