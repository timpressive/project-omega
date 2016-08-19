@extends('layout.admin')
@section('title', 'Settings')
@section('content')
	<main class="controls">
		<h2>SPEL BEHEREN</h2>
		<a href="admin/game/start" class="btn-start">Start</a>
		<div class="row">
			<h4>STRAFFEN</h4>
			<div class="col-md-6"><button class="btn btn-primary">Tijd aftrekken</button></div>
			<div class="col-md-6"><button class="btn btn-primary">Opdracht geslaagd</button></div>
		</div>
		<div class="row">
			<h4>BELONEN</h4>
			<div class="col-md-6"><button class="btn btn-primary">Opdracht gefaald</button></div>
			<div class="col-md-6"><button class="btn btn-primary">Spel pauzeren</button></div>
		</div>
	</main>
@stop