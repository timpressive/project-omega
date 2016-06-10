var options = ["red", "yellow", "green", "blue", "purple"];
var key = [];
codeLength = 4;
$(function() {
	$('.colors i').click(function(e) { toggleColor($(this)); });
	$("#check").click(function(e) { checkCode(); });
	$(".clear").click(function(e) { clearVerification(); });

	for (var i = 0; i < codeLength; i++) {
		index = Math.floor(Math.random() * ((options.length-1) - 0));
		console.log(index);
		key[i] = options[index];
	}
});

function toggleColor($el) {
	var color = $el.css("color");
	switch (color) {
		case "rgb(255, 83, 83)":
			$el.css("color", 'rgb(255, 255, 83)');
			break;
		case "rgb(255, 255, 83)":
			$el.css("color", 'rgb(128, 255, 0)');
			break;
		case "rgb(128, 255, 0)":
			$el.css("color", 'rgb(0, 255, 255)');
			break;
		case "rgb(0, 255, 255)":
			$el.css("color", 'rgb(128, 0, 255)');
			break;
		case "rgb(128, 0, 255)":
		default:
			$el.css("color", 'rgb(255, 83, 83)');
			break;
	}
}

function checkCode() {
	clearVerification();
	// deep copy of key array
	var answers = key.slice(0);

	var code = [];
	for (var i = 1; i <= $(".colors i").length; i++) {
		var color = $(".colors i:nth-child("+i+")").css("color");
		switch (color) {
			case "rgb(255, 83, 83)":
			color = "red";
				break;
			case "rgb(255, 255, 83)":
				color = "yellow";
				break;
			case "rgb(128, 255, 0)":
				color = "green";
				break;
			case "rgb(0, 255, 255)":
				color = "blue";
				break;
			case "rgb(128, 0, 255)":
				color = "purple";
				break;
			default:
				color = null;
				break;
		}
		code.push(color);
	}
	var correct = color = 0;
	
	if (arrayEqual(key, code)) { $('.verify .color').addClass("correct"); return true; }
	else {
		for (var i = 0; i < key.length; i++) {
			// if slot is correct
			if (code[i] === key[i]) {
				correct++;
				color++;
				answers[i] = null;
			}

			// if color is in guess array
			else if ($.inArray(code[i], answers) > -1) {
				color++;
				answers[$.inArray(code[i], answers)] = null;
			} 
		}

		for (var i = 0; i < color; i++) {
			$el = $(".verify .color:nth-child(" + (i+1) +")");

			if (i < correct) {$el.addClass("correct");}
			else { $el.addClass("right-color");}
		}
	}
}

function arrayEqual(first, second) {
	if (first.length !== second.length) {return false;}

	for (var i = first.length - 1; i >= 0; i--) {
		if (first[i] != second[i]) {return false;}
	}
	return true;
}

function clearVerification() {
	$('.verify .color').removeClass("correct");
	$('.verify .color').removeClass("right-color");
}