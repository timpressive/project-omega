<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, user-scalable=0" />
		<title>Protocol 66</title>
		<style>
			body { margin: 0; background-color: #000; }
			#maze { margin: auto; display: block; position: absolute; top: 0; left: 0; right: 0; bottom: 0; }
		</style>
	</head>
	<body>
		<!-- <h2 style="color: white; text-align: center">Leidt het virus manueel naar de container.</h2> -->
		<canvas id="maze"></canvas>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="{{ asset('js/maze.js')}}"></script>
		<script>Maze.init();</script>
	</body>
</html>