@extends('layout.admin')
@section('title', 'Settings')
@section('content')
	<main class="controls">
		<h2>SPEL BEHEREN</h2>
		<p>Vanop deze pagina kan je de spelverloop wat controleren. Als je vals spel vermoed trek je tijd af, als er iets gebeurt of je wilt zeker zijn dat ze winnen pauzeer je de timer.</p>
		<p>Het spel starten of stoppen doe je met de grote groene/rode knop</p>
		<a id="start" href="#" class="btn-{{ ($started == 1) ? 'stop' : 'start' }} {{ ($started == 1) ? 'stop' : 'start' }}">{{ ($started == 1) ? 'Stop' : 'Start'  }}</a>
		<div class="row">
			<h4>STRAFFEN & BELONEN</h4>
			<div class="col-md-6"><button id="penalty" class="btn btn-primary">5 min. aftrekken</button></div>
			<div class="col-md-6"><button id="pause" class="btn btn-primary {{ ($paused == 1) ? 'unpause' : 'pause' }}">{{ ($paused == 1) ? 'Verder spelen' : 'Spel pauzeren' }}</button></div>
		</div>
	</main>
@stop

@section('js')
	<script>
		$(function() {
			setInterval(getStates, 3000);

			$('body')
				.on('click', '#start', function (e) {
					e.preventDefault();

					if ($(this).hasClass('start')) {
						start($(this));
					} else {
						stop($(this));
					}
				});

			$('#pause').click(function (e) { e.preventDefault(); togglePause(); });
			$('#penalty').click(function (e) { e.preventDefault(); penalty(); });
		});

		function start($this) {
			console.log($this);
			$.ajax({
				url: 'ajax/start-game',
				method: 'GET',
				success: function () {
					$this
						.removeClass('btn-start')
						.addClass('btn-stop')
						.removeClass('start')
						.addClass('stop')
						.text('Stop');
				}
			});
		}
		function stop($this) {
			console.log($this);
			$.ajax({
				url: 'ajax/stop',
				method: 'GET',
				success: function () {
					$this
						.addClass('btn-start')
						.removeClass('btn-stop')
						.addClass('start')
						.removeClass('stop')
						.text('Start');
				}
			});
		}
		function togglePause() {
			$.ajax({
				url: 'ajax/pause-game',
				method: 'GET',
				success: function (text) {
					$('#pause')
						.toggleClass('pause')
						.toggleClass('unpause')
						.text(text);
				},
				error: function (data) { console.error(data); }
			});
		}
		function penalty() {
			$.ajax({
				url: 'ajax/penalty',
				method: 'GET',
				success: function () {
					console.log('-5 min.');
				}
			});
		}
		function getStates() {
			console.log('states');
			var paused, active;

			$.ajax({
				url: 'ajax/get-active',
				method: 'GET',
				success: function (data) {
					active = parseInt(data);

					if (active && $('#start').hasClass('start')) {
						$('#start')
							.text('Stop')
							.removeClass('btn-start')
							.addClass('btn-stop')
							.removeClass('start')
							.addClass('stop');
					}
					if (!active && $('#start').hasClass('stop')) {
						$('#start')
							.text('Start')
							.removeClass('btn-stop')
							.addClass('btn-start')
							.removeClass('stop')
							.addClass('start');
					}
				}
			});

			$.ajax({
				url: 'ajax/get-paused',
				method: 'GET',
				success: function (data) {
					var text = '';

					paused = parseInt(data);

					if (paused) { text = 'Verder spelen'; }
					else { text = 'Spel pauzeren'; }

					$('#pause')
						.toggleClass('pause')
						.toggleClass('unpause')
						.text(text);
					console.log(paused);
				}
			});
		}
	</script>
@stop
