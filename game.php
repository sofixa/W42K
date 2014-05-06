<!DOCTYPE html>
<html>
<head>
<?php 
if (file_exists("includes/conf.php"))
	include_once("includes/conf.php");
else
	header('Location: install.php');
include_once("includes/includes.php");
?>
	<title>Game lobby | <?php echo $name; ?></title>
<script>
function createGame(name, uid)
{
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			alert("Successfully created game!");
		}
	}
	xmlhttp.open("GET","includes/ops.php?action=createGame&name="+name+"&uid1="+uid,true);
	xmlhttp.send();
}

function joinGame(gid, uid)
{
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			alert(xmlhttp.responseText);
			alert("Joined game! You will be redirected shortly");
			window.location.href = "displayGame.php";
		}
	}
	xmlhttp.open("GET","includes/ops.php?action=joinGame&gid="+gid+"&uid="+uid,true);
	xmlhttp.send();
}

function getGames()
{
	if (window.XMLHttpRequest)
	{
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("results").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","includes/ops.php?action=getGames",true);
	xmlhttp.send();
}
</script>
<style>
#tablee {
color: white;

}
</style>
		</head>
<body>
	<center>
		<a href='index.php'><img src='images/warhammer-40000-logo.png' border=0 width=800px /></a>
		<div id='structure' style="background-image:url('images/stars.jpg')">
<form method="post" action="">
<p style="color:white;">Create a game: </p>
					<p><input style="width:200px; height:43px" type="text" id="game" name="game" placeholder='Game name' autofocus required /></p>
					<p><input id='button' type="button" name="submit" value="OK" style="width:100px;" onclick="createGame(document.getElementById('game').value, <?php echo $_SESSION['uid']; ?>);" /></p>
</form>
<button id="button" style="width:150px;" onclick="getGames();">Load games</button>
<div id="results"></div>
</div>
		<br \>
<br />
<br />
<?php
include_once("includes/menu.php");
?>
	</center>
</body>
</html>
