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
			<title>Create Account | <?php echo $name; ?></title>
	</head>
	<body>
		<center>
			<a href='index.php'><img src='images/warhammer-40000-logo.png' border=0 width=800px /></a>
			<div id='structure' style="background-image:url('images/stars.jpg')">
				<div id="form">
<?php
if (!empty($_POST) && isset($_GET['action']) && $_GET['action'] === "register") {
	$query = "INSERT INTO users (name, email, uname, pass)
		VALUES (?, ?, ?, ?)";
	$sql = mysqli_prepare($con, $query);
	if (!mysqli_stmt_bind_param($sql, 'ssss', $_POST['name'], $_POST['email'], $_POST['uname'], hash('sha512', $_POST['pass'])))
		echo "Something went wrong".mysqli_stmt_error($sql);
	if (!mysqli_stmt_execute($sql))
		echo "Something went wrong".mysqli_stmt_error($sql);
	else
		echo "<p>Successfully registered!</p>";
}
else {
?>
					<form method="post" action="create.php?action=register">
						<p><input style="width:200px; height:43px" type="text" name="uname" placeholder='Username' autofocus required /></p>
						<p><input style="width:200px; height:43px" type="password" name="pass" placeholder='Password' required /></p>
	<p><input style="width:200px; height:43px" type="text" name="name" placeholder='Full name' autofocus required /></p>
	<p><input style="width:200px; height:43px" type="text" name="email" placeholder='Email' autofocus required /></p>
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
