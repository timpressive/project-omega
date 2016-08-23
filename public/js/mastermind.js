var options = ["red", "yellow", "green", "blue", "purple"];
var key = [];
var tries = 0;
var codeLength = 2 + (level * 2);
var maxTries = 5 + (level * 5);

$(function() {
	$('.verify .color:nth-child(' + (codeLength/2 + 1) + ')').css('clear', 'left');

	$('.colors i').click(function(e) { toggleColor($(this)); });
	$("#check").click(function(e) {
		if (completedSequence()) {
			if (tries < maxTries ) {
				addAttempt();
				verify();
			}
		}
	});

	createCode();
});

//-- EVENT HANDLERS --//

	// toggles the clicked slot's color
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

// END EVENT HANLERS //

// checks an attempt against the puzzle solution
function verify() {
	// deep copy of key array
	var answers = key.slice(0);
	var code = getColors();
	var correct = 0;
	var color = 0;

	// if attempt is completely correct
	if (arrayEqual(key, code)) {
		$('.attempt:last-child .verify .color').addClass('correct');
		$('.controls').hide();
		win();
	} else {
		for (var i = 0; i < answers.length; i++) {
			// if slot is correct
			if (code[i] === answers[i]) {
				correct++;
				color++;

				answers[i] = null;
				code[i] = null;
			}

			// if color is in guess array
			else if ($.inArray(answers[i], code) > -1) {
				color++;
				code[$.inArray(answers[i], code)] = null;
				answers[i] = null;
			} 
		}

		for (var i = 1; i <= color; i++) {
			$el = $('.attempt:last-child .verify .color:nth-child(' + i +')');

			if (i <= correct) {$el.addClass('correct');}
			else { $el.addClass('right-color');}
		}

		// hide input when the maximum amount of tries has been reached
		if (tries >= maxTries) { $('.controls').hide(); }

		tries++;
	}
}

function win() {
	if (level == 3) {
		message = 'Code correct, toegang tot console...';
	} else {
		message = 'Code correct, ga naar het volgende niveau...';
	}

	$('.message')
		.addClass('success')
		.text(message);

	$.get(base_url+'/game/decrypt-level', {'level': level});

	$('.proceed').show();
	$('#check').hide();
}

// check wether two arrays are identical
// use to see if a solution is 100% correct
function arrayEqual(first, second) {
	if (first.length !== second.length) {return false;}

	for (var i = first.length - 1; i >= 0; i--) {
		if (first[i] != second[i]) {return false;}
	}
	return true;
}

// gets the color per slot and changes the rgb value
// to a string with the color name
function getColors() {
	var code = [];

	for (var i = 1; i <= $(".attempt:last-child .colors i").length; i++) {
		var color = $(".attempt:last-child .colors i:nth-child("+i+")").css("color");
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
	return code;
}

// creates a new row with the current confuguration
function addAttempt() {
	var $attempt = $('.controls').clone();
	$attempt
		.removeClass('controls')
		.addClass('attempt')
		.appendTo('.attempts');

	$controls = $('#mastermind .controls');
	$controls.find('i').css('color', '');

	$('html, body').scrollTop($controls.offset().top);
}

// creates solution to puzzle
function createCode() {
	for (var i = 0; i < codeLength; i++) {
		index = Math.floor(Math.random() * ((options.length) - 0));
		key[i] = options[index];
	}

	if (key.allValuesEqual()) {  createCode(); }
}

// checks if all slots are filled in
function completedSequence() {
	var complete = true;
	$.each($('.controls .colors>i'), function (i, $el) {
		if ($($el).css('color') == 'rgb(85, 85, 85)') {
			complete = false;
		}
	});

	if (complete == false) { alert('Oeps! Je hebt niet alles ingevuld!'); }

	return complete;
}

// checks if every value of an array is the same
// used to make sure codes aren't made up of only one color
Array.prototype.allValuesEqual = function() {

    for(var i = 1; i < this.length; i++)
    {
        if(this[i] !== this[0])
            return false;
    }

    return true;
}