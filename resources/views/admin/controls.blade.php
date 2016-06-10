@extends('layout.admin')
@section('title', 'Settings')
@section('content')
	<main class="controls">
		<h2>SPEL BEHEREN</h2>
		<a href="admin/game/start" class="btn error">Start</a>
		<div>
			<h3>STRAFFEN</h3>
			<button class="btn btn-primary">Tijd aftrekken</button>
			<button class="btn btn-primary">Opdracht gefaald</button>
		</div>
		<div>
			<h3>BELONEN</h3>
			<button class="btn btn-primary">Opdracht geslaagd</button>
			<button class="btn btn-primary">Spel pauzeren</button>
		</div>
	</main>
@stop