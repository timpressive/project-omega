<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
		<title>Admin</title>
	</head>
	<body>
		<div class="row">
			<a href="{{ route('code.edit') }}" class="btn-primary">Code wijzigen</a>
		</div>
		<div class="row">
			<a href="{{ route('lock.index') }}" class="btn-primary">Slot beheren</a>
		</div>
	</body>
</html>