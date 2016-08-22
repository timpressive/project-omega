<!doctype html>
<html>
	<head>
		<base href="{{ asset('/') }}">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, max-scale=1">
		<link rel="stylesheet" href="{{ asset('css/lib/font-awesome.min.css' ) }}">
		<link rel="stylesheet" href="{{ asset('css/lib/bootstrap.min.css' ) }}">
		<link rel="stylesheet" href="{{ asset('css/style.css' )}}">
		<title>@yield('title') | Admin</title>
	</head>
	<body id="admin">
		<div class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-navicon"></i></button>
					<a class="navbar-brand" href="/"><img id="logo" src="img/name-white.png" alt="logo"></a>
				</div>
				<nav class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						@if (Auth::check())
							<li {{{ (Request::is('admin') || Request::is('admin/dashboard')) ? 'class=active' : '' }}}><a href="admin/dashboard">Dashboard</a></li>
							<li {{{ (Request::is('admin/instructions')) ? 'class=active' : '' }}}><a href="admin/instructions">Instructies</a></li>
							<li {{{ (Request::is('admin/game')) ? 'class=active' : '' }}}><a href="admin/game">Spelbeheer</a></li>
							<li {{{ (Request::is('admin/settings')) ? 'class=active' : '' }}}><a href="admin/settings">Instellingen <i class="fa fa-cogs"></i></a></li>
						@else
							<li><a href="overzicht" <?= (Request::is('overzicht')) ? 'class="active"' : '' ?>>Overzicht</a></li>
							<li><a href="console">Console</a></li>
						@endif
					</ul>
				</nav>
				<!--/.nav-collapse -->
			</div>
	    </div>
	    @include('partial.success')
	    @include('partial.error')
		<div class="container">
			@yield('content')
		</div>
		<script src="{{ asset('js/lib/jquery-2.2.3.min.js' )}}"></script>
		<script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>
		@yield('js')
	</body>
</html>