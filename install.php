<html>
<head>
<?php
include_once("includes/includes.php");
if (file_exists("includes/conf.php"))
	header('Location: index.php');
?>
	<title>Install <?php echo $name; ?> </title>
<style>
body {
color:white;
}
</style>
</head>
<body>
<?php
if (!empty($_POST)) {
	if (!$_POST['mysqlhost'] || !$_POST['mysqluser'] || !$_POST['mysqlpass'] || !$_POST['mysqldb'] || !$_POST['apass'])
		echo "Missing argument, go back and fill the form properly!\n";
	else {
		$con=mysqli_connect($_POST['mysqlhost'],$_POST['mysqluser'],$_POST['mysqlpass']);
		if (mysqli_connect_errno()) {
			echo "Failed to connect to the MySQL server, are you sure it's running and the details are correct?\n";
			die ("Error Report:".mysqli_connect_error());
		}
		else {
			$db = mysqli_select_db($con, $_POST['mysqldb']);
			if (!$db) {
				if (!mysqli_query($con, "CREATE DATABASE ".$_POST['mysqldb']))
					die ("Error creating database ".mysqli_error($con)."\n");
				else {
					echo "Successfully created database ".$_POST['mysqldb']."\n";
					$db = mysqli_select_db($con, $_POST['mysqldb']);
				}
			}
			$sql = "CREATE TABLE IF NOT EXISTS `users` (
				`uid` int(11) NOT NULL auto_increment,
				`name` varchar(255) default NULL,
				`email` varchar(255) default NULL,
				`uname` varchar(255) default NULL,
				`pass` text,
				`admin` tinyint(1),
				PRIMARY KEY (`uid`),
				UNIQUE KEY (`uname`)
			);";
			if(mysqli_query($con, $sql)) {
				$sql3 = "CREATE TABLE IF NOT EXISTS `games` (
					`gid` INT NOT NULL auto_increment,
					`uid1` INT NOT NULL,
					`uid2` INT default NULL,
					`uid3` INT default NULL,
					`uid4` INT default NULL,
					`game` TEXT NOT NULL,
					PRIMARY KEY(`gid`),
					FOREIGN KEY (uid1) REFERENCES users(uid),
					FOREIGN KEY (uid2) REFERENCES users(uid),
					FOREIGN KEY (uid3) REFERENCES users(uid),
					FOREIGN KEY (uid4) REFERENCES users(uid));";
				if (mysqli_query($con, $sql3)) {
					$sql2 = "CREATE TABLE IF NOT EXISTS `ships` (
						`sid` INT NOT NULL auto_increment,
						`name` VARCHAR(255) NOT NULL,
						`gid` INT NOT NULL,
						`uid` INT NOT NULL,
						`x` INT NOT NULL,
						`y` INT NOT NULL,
						`dir` ENUM('E', 'W', 'N', 'S') NOT NULL,
						`health` INT NOT NULL,
						`power` INT NOT NULL,
						`speed` INT NOT NULL,
						`maneuver` INT NOT NULL,
						`armor` INT NOT NULL,
						`weapons` INT NOT NULL,
						`width` INT NOT NULL,
						`height` INT NOT NULL,
						`type` INT NOT NULL,
						`alive` ENUM('alive', 'dead') NOT NULL,
						PRIMARY KEY(`sid`),
						FOREIGN KEY(gid) REFERENCES games(gid),
						FOREIGN KEY(uid) REFERENCES users(uid)
);";
					if (mysqli_query($con, $sql2)) {
					$hash = hash('sha512', $_POST['apass']);
					if(!mysqli_query($con, "INSERT INTO users (name, uname, pass, admin) VALUES ('admin', 'admin', '$hash', '1')"))
						echo ("Something went wrong while creating admin account".mysqli_error($con));
					echo "Successfully created tables!\n";
					file_put_contents("includes/conf.php", '<?php '."\n".'session_start();'."\n".'$con=mysqli_connect("'.$_POST["mysqlhost"].'", "'.$_POST["mysqluser"].'", "'.$_POST["mysqlpass"].'", "'.$_POST["mysqldb"].'");'."\n".'if(mysqli_connect_errno())'."\n".'die("Failed to connect to the db."); ?> '."\n".'');
				}
				else
					die ("Unsuccess! Try again?\n".mysqli_error($con));
				}
				else
					die ("Unsuccess! Try again?\n".mysqli_error($con));
			}
	}
}
mysqli_close($con);
	}
else {
?>
<form action="install.php" method="post">
<p>Before we can use <?php echo $name; ?>, we need to install it!. <br />
First, we'll make our MySQL configs. If you don't know what you're doing, don't change them, just type the password you entered while installing MAPM</p>
MySQL host:
<input type="text" name="mysqlhost" id="mysqlhost" value="localhost" /><br />
MySQL user:
<input type="text" name="mysqluser" id="mysqluser" value="root" /> <br />
MySQL password:
<input type="password" name="mysqlpass" id="mysqlpass" /><br />
MySQL database: (if it doesn't exist, it will be created)
<input type="text" name="mysqldb" id="mysqldb" value="rush01" /><br />
Site admin password<input type="password" name="apass" /><br />
<input type="submit" name="submit" value="Submit" />
</form>
<?php
}
?>
</body>
</html>
