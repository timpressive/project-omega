<!doctype html>
<html>
	<head>
		<base href="{{ asset('/') }}">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="{{ asset('css/lib/font-awesome.min.css' ) }}">
		<link rel="stylesheet" href="{{ asset('css/lib/bootstrap.min.css' ) }}">
		<link rel="stylesheet" href="{{ asset('css/style.css' ) }}">
		<title>
			@yield('title')
		</title>
	</head>
	<body>
		@if(!isset($title))
		<div class="navbar">
			<img src="img/name-white.png" id="logo" alt="logo">
			@if (session()->has('access') && session('access') == 1)
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-navicon"></i></button>
				</div>
				<nav class="collapse navbar-collapse">
					<ul>
						<li><a href="overzicht" <?= (Request::is('overzicht')) ? 'class="active"' : '' ?>>Overzicht</a></li>
						<li><a class="console" href="console">Console</a></li>
					</ul>
				</nav>
			@endif
		</div>
		@endif
		<div class="container">
			@yield('content')
		</div>
		<script>var base_url = '{{ url('/') }}'</script>

		<script src="{{ asset('js/lib/jquery-2.2.3.min.js' )}}"></script>
		<script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>
		@yield('js')
	</body>
</html>