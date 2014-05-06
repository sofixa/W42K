<!DOCTYPE html>
<html>
<head>
<?php
include_once("includes/includes.php");
?>
<title>Homepage <?php echo $name; ?></title>
</head>
<body onload='slide()'>
	<center>
		<a href='index.php'><img src='images/warhammer-40000-logo.png' border=0 width=800px /></a>
		<div id='structure'>
		</div>
		<br \>
<?php
include_once("includes/menu.php");
?>
	</center>
	<script type="text/javascript">
		var images = ['destro10.jpg', 'Gol_ships.jpg', '58637051936313733009.jpg'];
		var img_idx = 0;
		var structure = document.getElementById('structure');

		function slide() {
			structure.style.backgroundImage = "url(images/" + images[img_idx] + ")";
			img_idx++;
			if (img_idx>=images.length) {
				img_idx = 0;
			}

		}
		window.setInterval(slide,5000);
	</script>
</body>
</html>
