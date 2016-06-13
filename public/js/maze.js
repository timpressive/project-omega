var touchX,
	touchY,
	startEvt,
	endEvt,
	startTime,
	endTime;

var collisionX, collisionY = 0;
var playing = true;


// Canvas and stuff
var Maze = {
	height: 320,
	width: 320,
	ratio: null,
	
	currentWidth: null,
	currentHeight: null,
	
	canvas: null,
	ctx: null,
	
	maze: new Image(),

	init: function () {
		Maze.canvas = document.getElementById('maze');
		
		Maze.canvas.width = Maze.width;
		Maze.canvas.height = Maze.height;
		Maze.ratio = Maze.width/Maze.height;

		Maze.ctx = Maze.canvas.getContext('2d');
		
		Maze.ua = navigator.userAgent.toLowerCase();
		Maze.android = Maze.ua.indexOf('android') > -1 ? true : false;
		Maze.ios = ( Maze.ua.indexOf('iphone') > -1 || Maze.ua.indexOf('ipad') > -1  ) ? true : false;

		Maze.resize();

		Maze.maze.src = "../img/maze.png";
		Maze.clear();

		Virus.init();
	},
	resize: function () {
		if (window.innerHeight > window.innerWidth) {
			Maze.width = window.innerWidth * .9;
		} else { Maze.width = window.innerHeight * .9; }
		Maze.height = Maze.width;

		Maze.canvas.width = Maze.width;
		Maze.canvas.height = Maze.height;

		Maze.canvas.style.width = Maze.width + 'px';
		Maze.canvas.style.height = Maze.height + 'px';

		window.setTimeout(function() { window.scrollTo(0, 1); }, 1);
	},
	clear: function() {
		
		Maze.ctx.clearRect(0, 0, Maze.width, Maze.height);
		Maze.ctx.drawImage(Maze.maze, 0, 0, Maze.width, Maze.height);
	},
};

var Virus = {
	r: 5,
	x: null,
	y: null,
	color: "#32CD00",

	init: function () {
		Virus.x = Maze.width / 2;
		Virus.y = Maze.height / 2;

		Virus.draw();
	},
	draw: function () {
		if (Virus.x < 0) {
			Virus.x = 0;
		} else if ( Virus.x > Maze.width - 10) {
			Virus.x = Maze.width - 10;
		}
		if (Virus.y < 0) {
			Virus.y = 0;
		} else if (Virus.y > Maze.height - 10) {
			Virus.y = Maze.height - 10;
		}

		Maze.ctx.fillStyle = Virus.color;
		Maze.ctx.beginPath();
		Maze.ctx.arc(Virus.x, Virus.y, Virus.r, 0, Math.PI * 2, true);
		Maze.ctx.closePath();
		Maze.ctx.fill();
	},
	move: function(currentX, currentY) {
		Maze.clear();

		var x = currentX - touchX;
		var y = currentY - touchY;

		Virus.checkCollision(Virus.x + x,Virus.y + y);

		if (collisionX) { x = 0; }
		if (collisionY) { y = 0; }

		Virus.x += x;
		Virus.y += y;

		touchX = currentX;
		touchY = currentY;

		Virus.draw();
		if (Virus.y <= 10 && (Virus.x > Maze.width/2 && Virus.x < Maze.width/2 + 30)) {
			$('#maze').hide();
			$('.console').show();
			playing = false;
			Console.stage = 5;
			Console.win();
		}
	},
	checkCollision: function (x,y) {
		var pixels = Maze.ctx.getImageData(x, y, 5, 5).data;
		var noCollissionX = true;
		var noCollissionY = true;

		for (var i = 0; i < pixels.length; i += 4) {
			var pixX = x + (i / 4) % 5;
			var pixY = y + Math.floor((i / 4) / 5);

			if (pixels[i+3] != 0) {
				if ((x <= pixX && pixX <= Virus.x) || (Virus.x <= pixX && pixX <= x)) {
					collisionX = 1;
					noCollissionX = false;
				}
				if ((y <= pixY && pixY <= Virus.y) || (Virus.y <= pixY && pixY <= y)) {
					collisionY = 1;
					noCollissionY = false;
				}
			}
		}

		if (noCollissionX) { collisionX = 0; }
		if (noCollissionY) { collisionY = 0; }
	}
}


//--- EVENT LISTENERS ---//
window.addEventListener('load', Maze.init, false);
window.addEventListener('resize', Maze.resize, false);
window.addEventListener('touchstart', function(e) {
	// prevent zooming
	e.preventDefault();
	
	startEvt = new Date().getTime();
	touchX = e.touches[0].clientX;
	touchY = e.touches[0].clientY;
}, false);
window.addEventListener('touchmove', function(e) {
	// prevent zooming
	e.preventDefault();
	if (playing) {
		handleMove(e.touches[0].clientX, e.touches[0].clientY);
	}
}, false);
window.addEventListener('dragstart', function(e) {
	touchX = e.clientX;
	touchY = e.clientY;
}, false);

window.addEventListener('drag', function(e) {
	handleMove(e.clientX, e.clientY)
}, false);
window.addEventListener('touchend', function(e) {
	// prevent zooming
	e.preventDefault();
}, false);
window.addEventListener('orientationchange', function (e) {
	Maze.resize();
	Maze.clear();

	Virus.draw();
});
//- END EVENT LISTENERS -//

function handleMove(x, y) {
	endEvt = new Date().getTime();

	var speed = Math.abs((x - touchX + y - touchY) / 2) / (endEvt - startEvt) * 1000;

	if (speed <= 70) {
		Virus.move(x, y);
	}

	touchX = x;
	touchY = y;

	startEvt = new Date().getTime();
}