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
	<title>Login | <?php echo $name; ?></title>
		</head>
<body>
	<center>
		<a href='index.php'><img src='images/warhammer-40000-logo.png' border=0 width=800px /></a>
		<div id='structure' style="background-image:url('images/stars.jpg')">
	<div id="form">
<?php
if (!empty($_POST) && isset($_GET['action']) && $_GET['action'] === "log") {
		$query = "SELECT uname, uid FROM users WHERE uname = ? AND pass = ? LIMIT 1";
		$sql = mysqli_prepare($con, $query);
		mysqli_stmt_bind_param($sql, 'ss', $_POST['uname'], hash('sha512', $_POST['pass']));
		if (!mysqli_stmt_execute($sql))
			die ("Something went wrong".mysqli_stmt_error($sql));
		mysqli_stmt_bind_result($sql, $result, $id);
		if(mysqli_stmt_fetch($sql)) {
			$_SESSION['uname'] = $result;
			$_SESSION['uid'] = $id;
			echo "<p>Successfully logged in!</p>";
		}
		else
			echo "<p>Login failed</p>";
		mysqli_stmt_close($sql);
	}
	else if (!empty($_GET) && isset($_GET['action']) && $_GET['action'] == "logout")
	{
		session_destroy();
		header('Location: index.php');
	}
	else {
?>


			<form method="post" action="login.php?action=log">
					<p><input style="width:200px; height:43px" type="text" name="uname" placeholder='Username' autofocus required /></p>
					<p><input style="width:200px; height:43px" type="password" name="pass" placeholder='Password' required /></p>
					<p><input id='button' type="submit" name="submit" value="OK" /></p>
				</form>
<?php
	}
?>
			</div>
		</div>
		<br \>
<?php
	include_once("includes/menu.php");
?>
	</center>
</body>
</html>
