function drawGrid(board) {

	pen = board.getContext('2d');
	pen.lineWidth = 1;
	gridSize = 10;
	pen.beginPath();
	pen.strokeStyle = 'black';
	pen.fillRect(0, 0, 1500, 1000)
	pen.strokeStyle = 'lightgrey';
	for (var h = gridSize; h < board.height; h += 10) {
		pen.moveTo(0, h);
		pen.lineTo(board.width, h);
	}
	for (var w = gridSize; w < board.width; w += 10) {
		pen.moveTo(w, 0);
		pen.lineTo(w, board.height);
	}
	pen.stroke();
	return (pen);
}

function selectShip(board, x, y, width, height, dir, sid, health, power, speed, maneuver, armor, weapons, type, name) {

	document.getElementById("controls").style.display = "block";
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
			document.getElementById("sname").innerHTML = name;
			document.getElementById("spower").innerHTML = power;
			document.getElementById("sarmor").innerHTML = armor;
			document.getElementById("sweapons").innerHTML = weapons;
			document.getElementById("shealth").innerHTML = health;
			g_board = board;
			g_x = x;
			g_y = y;
			g_name = name;
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
	xmlhttp.open("GET","includes/ops.php?action=selectShip&sid="+sid,true);
	xmlhttp.send();
}

function drawShip(board, posX, posY, dir, scaleX, scaleY, type) {
	boardContext = board.getContext('2d');
	var ship = new Image();
	ship.src = '../images/ships/ship'+type+'_'+dir+'.png';
	ship.onload = function() {
		boardContext.drawImage(ship, posX, posY, scaleX, scaleY);
		boardContext.beginPath();
		boardContext.stroke();
	}
}

function drawBoard(gid, uid) {

	board = document.getElementById('my_canvas');
	drawGrid(board);
	getShip(gid, board, uid);
}

function clickable(board, obj) {
	var elem = document.getElementById('my_canvas'),
		elemLeft = elem.offsetLeft,
		elemTop = elem.offsetTop,
		context = elem.getContext('2d'),
		elements = [];

	elem.addEventListener('click', function(event) {

		var x = event.pageX - elemLeft,
		y = event.pageY - elemTop;
	elements.forEach(function(element) {
		var a = 1*element.y + 1*element.height;
		var b = 1*element.x + 1*element.width;
		console.log(x, y, element.x, element.y, element.height, element.width);
		console.log(y > element.y, y < a, x > element.x, x < b);
		if (y > element.y && y < a && x > element.x && x < b && element.uid == g_uid) {
			selectShip(board, element.x, element.y, element.width, element.height, element.dir, element.sid, element.health, element.power, element.speed, element.maneuver, element.armor, element.weapons, element.type, element.name);
		}
	});
	}, false);
	for (key in obj) {
		elements.push({
			uid: obj[key].uid,
			health: obj[key].health,
			power: obj[key].power,
			speed: obj[key].speed,
			maneuver: obj[key].maneuver,
			armor: obj[key].armor,
			weapons: obj[key].weapons,
			type: obj[key].type,
			name: obj[key].name,
			dir: obj[key].dir,
			sid: obj[key].sid,
			width: obj[key].width,
			height: obj[key].height,
			y: obj[key].y,
			x: obj[key].x
		});
	}
}
