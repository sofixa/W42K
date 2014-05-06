function getShip(gid, board, uid)
{
	if (gid=="")
	{
		return;
	}
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
			var obj = JSON.parse(xmlhttp.responseText);
			for (key in obj) {
				drawShip(board, obj[key].x, obj[key].y, obj[key].dir, obj[key].width, obj[key].height, obj[key].type);
			}
			clickable(board, obj, uid);
		}
	}
	xmlhttp.open("GET","includes/ops.php?action=getShip&gid="+gid,true);
	xmlhttp.send();
}

function moveLeft(gid) {
	if (g_power > 0) {
		if (g_dir == "S")
			g_dir = "W";
		else if (g_dir == "W")
			g_dir = "N";
		else if (g_dir == "N")
			g_dir = "E";
		else if (g_dir == "E")
			g_dir = "S";
		g_power -= 1;
	}
	updateShip(g_board, g_sid, g_x, g_y, g_sid, g_dir, g_health, g_power, g_speed, g_armor, g_weapons, g_height, g_width, gid, g_maneuver);
}

function moveRight(gid) {
	if (g_power > 0) {
		if (g_dir == "S")
			g_dir = "E";
		else if (g_dir == "W")
			g_dir = "S";
		else if (g_dir == "N")
			g_dir = "W";
		else if (g_dir == "E")
			g_dir = "N";
		g_power -= 1;
	}
	updateShip(g_board, g_sid, g_x, g_y, g_sid, g_dir, g_health, g_power, g_speed, g_armor, g_weapons, g_height, g_width, gid);
}

function moveForward(gid) {
	if (g_power > 0) {
		if (g_dir == "S")
			g_y = 1*g_y - 1*10;
		if (g_dir == "W")
			g_x = 1*g_x - 1*10;
		if (g_dir == "N")
			g_y = 1*g_y + 1*10;
		if (g_dir == "E")
			g_x = 1*g_x + 1*10;
		g_power -= 1*1;
	}
	updateShip(g_board, g_sid, g_x, g_y, g_sid, g_dir, g_health, g_power, g_speed, g_armor, g_weapons, g_height, g_width, gid);
}

function ifObstacle(x, y, width, height) {

}

function updateShip(board, sid, x, y, sid, dir, health, power, speed, armor, weapons, height, width, gid, maneuver)
{

	var alive = ifObstacle(x, y, width, height);
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
			drawBoard(gid, g_uid);
			document.getElementById("sname").innerHTML = g_name;
			document.getElementById("spower").innerHTML = power;
			document.getElementById("sarmor").innerHTML = armor;
			document.getElementById("sweapons").innerHTML = weapons;
			document.getElementById("shealth").innerHTML = health;
			g_board = board;
			g_x = x;
			g_y = y;
			g_dir = dir;
			g_height = height;
			g_width = width;
			g_sid = sid;
			g_health = health;
			g_power = power;
			g_speed = speed;
			g_armor = armor;
			g_weapons = weapons;
			$(function() {
				$( "#progressbar" ).progressbar({
					max: 45,
					value: document.getElementById("shealth").innerHTML
				});
			});
		}
	}
	console.log("includes/ops.php?action=updateShip&sid="+sid+"&x="+x+"&y="+y+"&dir="+dir+"&health="+health+"&power="+power+"&speed="+speed+"&armor="+armor+"&weapons="+weapons+"&alive="+alive);
	xmlhttp.open("GET","includes/ops.php?action=updateShip&sid="+sid+"&x="+x+"&y="+y+"&dir="+dir+"&health="+health+"&power="+power+"&speed="+speed+"&armor="+armor+"&weapons="+weapons+"&alive="+alive,true);
	xmlhttp.send();
}
