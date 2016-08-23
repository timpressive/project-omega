var Console = {
	stage: 0,
	password: 'password',
	functions: [
		{
			'title': 'help',
			'description': 'Oplijsting van beschikbare functies.'
		},
		{
			'title': 'clear',
			'description': 'Maak de terminal leeg.'
		},
		{
			'title': 'ls',
			'description': 'Oplijsting van alle bestanden.'
		},
		{
			'title': 'open [bestand]',
			'description': 'opent het bestand dat volgt op "open".'
		}
	],
	files: ['wachtwoorden.txt', 'memo-4.txt', 'memo-5.txt','memo-7.txt', 'memo-9.txt'],
	override: '',
	
	// functions
	runFunction: function(input) {
		input = input.toLowerCase();

		console.log(Console.override);

		if (input == Console.override.toLowerCase()) {
			Console.win();
		} else {
			var input = input.split(' ');
			var fn = input[0];
			switch (fn) {
				case 'help':
					Console.help();
					break;
				case 'ls':
					Console.list();
					break;
				case 'open':
					if (input[1] != null) { Console.open(input[1]); }
					else { Console.setOutput('de functie "open" verwacht een bestandsnaam.', 'red'); }
					break;
				case 'clear':
					Console.clear();
					break;
				case 'j':
				case 'ja':
					if (Console.stage > 0) { Console.handle66(true); }
					else { Console.setOutput('kan functie "j" niet vinden.', 'red'); }
					break;
				case 'n':
				case 'nee':
					if (Console.stage > 0) { Console.handle66(false) }
					else { Console.setOutput('kan functie "n" niet vinden.', 'red'); }
					break;
				default:
					if (Console.stage > 0) { Console.handle66(fn); }
					else { Console.setOutput('kan functie "' + fn + '" niet vinden', 'red'); }
					break;
			}
		}
	},
	open: function(file) {
		$('#console > .indicator').hide();

		$.get(base_url+'/ajax/file/'+file, function (content) {
	    	setTimeout(function () {
	    		if (content == 'error') {
	    			Console.setOutput('Bestand "' + file + '" niet gevonden', 'red');
					$('#console > .indicator').show();
	    		} else {
					Console.setOutput(file + ' openen...');
					setTimeout(function () {
	    				Console.setOutput(content);
						$('#console > .indicator').show();
				    }, 1000);
	    		}
	    	}, 1000);
			
		});
	},
	help: function() {
		var output = $('<ul/>').addClass('functions');

		$.each(Console.functions, function (i, v) {
			$li = $('<li/>');
			$('<span>')
				.addClass('fn')
				.html('- ' + v.title)
				.appendTo($li);

			$('<span/>')
				.addClass('desc')
				.html(v.description)
				.appendTo($li);

			$li.appendTo(output);
		});

		
		Console.setOutput(output);
	},
	list: function() {
		var tab = ' &emsp;&emsp;&emsp;&emsp; ';
		var output = tab;

		$.each(Console.files, function (i, v) {
			output += v + tab;
		});
		Console.setOutput(output);
	},
	clear: function() { $('#output').empty(); },

	// Output
	setOutput: function(string, color = false) {
		var $data = $('<p/>').html(string);
		if (color) {
			switch (color) {
				case 'green':
					color = '#32CD00';
					break;
				case 'red':
					color = '#CD0000';
					break;
			}
			$data.css('color', color);
		}
		$('#output').append($data);

		$currentP = $('#output p:last-child');
		
		$('#output').scrollTop($currentP.offset().top - $('#output').innerHeight() + $('#output').scrollTop() + $currentP.innerHeight() );
	},
	displayFunction: function(fn) {
		if (Console.stage == 0) {
			var p = $('<p/>')
				.appendTo("#output");
			$('<span/>')
				.addClass('indicator')
				.text('&>')
				.appendTo(p);

			$('<span/>')
				.text(fn)
				.appendTo(p);
		}
	},
	delay: function(output, delay) {
		setTimeout(function () {
			Console.setOutput(output);
	    }, delay);
	},

	// WIN
	win: function() {
		$('#output > .indicator').hide();
		switch (Console.stage) {
			case 0:
				Console.setOutput('uitvoeren protocol 66...');
				setTimeout(function () {

					Console.setOutput('activeren van nood protocols...');
					setTimeout(function () {

						Console.setOutput('klaar!', 'green');
						setTimeout(function () {

							Console.setOutput('overschrijven van beveiliging');
							setTimeout(function () {

								Console.setOutput('wachtwoord vereist:');
							}, 200);

						}, 200);

					}, 800);

			    }, 300);
			    Console.stage = 1;
				break;
			case 1:
				setTimeout(function () {

					Console.setOutput('dit comando stopt de verspreiding van het virus. Bent u zeker? [j/n]');
					Console.delay('typ "j" voor ja, "n" voor nee.', 10);

				}, 200);
			    Console.stage = 2;
				break;
			case 2:
				Console.delay('het virus zit al in de verstuiver, weet u zeker dat u het wilt verplaatsen? [j/n]', 300);
			    Console.stage = 3;
				break;
			case 3:
				setTimeout(function () {

					Console.setOutput('virus wordt verplaatst.');
					setTimeout(function () {

						Console.setOutput('koeling loskoppelen...');
						setTimeout(function () {

							Console.setOutput('klaar!', 'green');
							setTimeout(function () {

								Console.setOutput('virus klaarmaken voor verzegeling');
								setTimeout(function () {

									Console.setOutput('automatische verzegeling mislukt. neem de manuele controle over.');
									Console.setOutput('leid het virus langs de juiste weg uit de verstuiver.');
									Console.setOutput('Let op de snelheid! Als je te snel gaat treedt de veiligheid in werking en stopt het virus.');
									Console.setOutput('<br><br>Ben je klaar? [j/n]');
								
								}, 1000);

							}, 10);

						}, 500);

					}, 300);
					
				}, 1000);
			    Console.stage = 4;
				break;
			case 4:
				$('#maze').show();
				$('.console').hide();
				Maze.init();
				break;
			case 5:
				setTimeout(function () {

					setTimeout(function () {

						setTimeout(function() {

							Console.setOutput('<br><br><br>')
							Console.setOutput('Virus omgeleid en verzegeld. De verstuiver is nu inactief');
							Console.setOutput('Aftellen wordt gestopt...');
							Console.stage = 6;

							Console.win();
						}, 800);
						
					}, 200);

				}, 300);
				break;
			case 6:
				Console.loopPercentages(1);
				$('#command').prop('disabled', 'disabled');
				$.get(base_url+'/ajax/win', function () {} );
				break;
			default:
				break;
		}
	},
	handle66: function(input) {
		switch (Console.stage) {
			case 1:
				if (input == Console.password) {
					Console.setOutput('wachtwoord correct!', 'green');
					Console.win();
				} else {
					Console.setOutput('wachtwoord incorrect.', 'red');
					Console.stage = 0;
				}
				break;
			case 2:
			case 3:
			case 4:
			case 5:
				if (input) { Console.win(); }
				else {
					Console.setOutput('bewerking geannuleerd. Protocol 66 niet uitgevoerd.', 'red');
					Console.stage = 0;
				}
				break;
		}
	},
	loopPercentages: function(i) {
		setTimeout(function () {
			if (i == 10) { Console.setOutput('100% voltooid!', 'green') }
			else { Console.setOutput(i+'0% voltooid...'); }

			i++;
			if (i <= 10) { Console.loopPercentages(i); }
			else {
				Console.stage++;
				Console.win();
			}
		}, 800);
	},
}


$(function() {
	$.ajax({
		url: base_url+'ajax/get-command',
		dataType: 'text',
		async: false,
		method: 'GET',
		success: function (data) { Console.override = data; }
	}),
	// EVENTS
		$('#command').blur(function () { $(this).focus(); });

		$('#command').keydown(function (e) {
			// if ENTER signal is sent
			if (e.keyCode == '13') {
				var fn = $('#command').val()
				if (fn.length > 0) {
					Console.displayFunction(fn);
					Console.runFunction(fn);
					$('#command')
						.val('')
						.focus();
				}
			}
		});
	// END EVENTS
});


