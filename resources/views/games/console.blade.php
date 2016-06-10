<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Console | Project Omega</title>
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">	
	</head>
	<body id="console">
		<div class="console">
			<div id="screen">
				<div id="output">
					<p>
						|--------------------|<br>
						|** OMEGA TERMINAL **|<br>
						|--------------------|
					</p>
					<p>terminal actief</p>
					<p>hulp: type "help" voor een lijst met commando's.</p>
				</div>
			</div>
			<span class="indicator">&></span><input type="text" name="command" id="command" autofocus>
		</div>
		<canvas id="maze"></canvas>


		<script>var base_url = "{{ asset('/') }}";</script>
		<script src="{{ asset('js/lib/jquery-2.2.3.min.js' )}}"></script>
		<script src="{{ asset('js/maze.js') }}"></script>
		<script src="{{ asset('js/console.js') }}"></script>
	</body>
</html>