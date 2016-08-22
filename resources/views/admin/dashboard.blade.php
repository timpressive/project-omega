@extends('layout.admin')
@section('title', 'Dashboard')
@section('content')
	<div class="settings">
		<h2>Welkom bij<br>PROJECT OMEGA</h2>
		<p>Als spelleider heb je iets meer opties om het spel in goede banen te leiden.</p>
		<p></p>
		<ul>
			<li><a href="admin/game" class="btn">Spelinstellingen</a></li>
			<li><a href="admin/controls" class="btn">Spel beheren</a></li>
			<li><a href="admin/instructions" class="btn">Instructies</a></li>
		</ul>
	</div>
@stop