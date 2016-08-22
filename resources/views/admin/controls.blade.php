@extends('layout.admin')
@section('title', 'Settings')
@section('content')
	<main class="controls">
		<h2>SPEL BEHEREN</h2>
		<a id="{{ ($started) ? 'stop' : 'start' }}" href="#" class="btn-start">{{ ($started) ? 'Stop' : 'Start'  }}</a>
		<div class="row">
			<h4>STRAFFEN</h4>
			<div class="col-md-6"><button class="btn btn-primary">Tijd aftrekken</button></div>
		</div>
		<div class="row">
			<h4>BELONEN</h4>
			<div class="col-md-6"><button class="btn btn-primary">Spel pauzeren</button></div>
		</div>
	</main>
@stop

@section('js')
	<script>
		$(function() {
			setInterval(getStates(), 3000);

			$('#start').click(function (e) { e.preventDefault();  start(); });
			$('#stop').click(function (e) { e.preventDefault(); stop(); });
			$('#pause').click(function (e) { e.preventDefault(); togglePause(); });
			$('#penalty').click(function (e) { e.preventDefault(); penalty(); });
		});

		function start() {
			$.ajax({
				url: 'ajax/start-game',
				method: 'GET',
				success: function () {
					$('#start')
						.toggleClass('btn-start')
						.toggleClass('btn-stop')
						.attr('id', 'stop');
				}
			});
		}
		function stop() {
			$.ajax({
				url: 'ajax/stop',
				method: 'GET',
				success: function () {
					$('#stop')
						.toggleClass('btn-start')
						.toggleClass('btn-stop')
						.attr('id', 'start');
				}
			});
		}
		function togglePause() {
			$.ajax({
				url: 'ajax/pause',
				method: 'GET',
				success: function (text) {
					$('#pause')
						.toggleClass('pause')
						.toggleClass('unpause')
						.text(text);
				}
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
			var paused, active;

			$.ajax({
				url: 'ajax/get-active',
				method: 'GET',
				success: function (data) {
					active = parseInt(data);

					if (!active) {
						if ($('#stop').length > 0) {
							$('#stop')
								.text('Start')
								.attr('id', 'start');
						}
					} else {
						if ($('#start').length > 0) {
							$('#start')
								.text('Stop')
								attr('id', 'start');
						}
					}
				}
			});

			$.ajax({
				url: 'ajax/get-paused',
				method: 'GET',
				success: function (data) {
					var text = '';

					paused = parseInt(data);

					if (paused) { text = 'Doorgaan'; }
					else { text = 'Pauzeren'; }

					$('#pause')
						.toggleClass('pause')
						.toggleClass('unpause')
						.text(text);

				}
			});
		}
	</script>
@stop
