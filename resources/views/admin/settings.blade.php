@extends('layout.admin')
@section('title', 'Settings')
@section('content')
	<main class="settings">
		<h2>INSTELLINGEN</h2>
		<div>
			<h4>Codes wijzigen</h4>
			<form action="game/setcodes" method="POST">
				{{ csrf_field() }}
				<ul>
					<li>
						<label for="access-code">Toegangscode</label><br>
						<input id="access-code" type="text" name="access-code" placeholder="toegangscode" value="{{ $settings['access-code'] }}">
					</li>
					<li>
						<label for="pin-code">PIN-code</label><br>
						<input id="pin-code" type="text" name="pin-code" placeholder="pincode" value="{{ $settings['pin-code'] }}">
					</li>
					<button type="submit" class="btn btn-submit">Opslaan</button>
				</ul>	
			</form>
		</div>
		<div>
			<h4>Spelduur instellen</h4>
			<form id="time" action="game/setduration" method="POST">
				{{ csrf_field() }}
				<ul>
					<li>
						<input type="number" name="hours" id="hours" min="0" max="5" placeholder="U" value="{{ $settings['hours'] }}" length="2"> : 
						<input type="number" name="minutes" id="minutes" min="0" max="59" placeholder="MM" value="{{ $settings['minutes'] }}" length="2"> : 
						<input type="number" name="seconds" id="seconds" min="0" max="59" placeholder="SS" value="{{ $settings['seconds'] }}" length="2">
					</li>
					<li><button type="submit" class="btn btn-submit">Opslaan</button></li></li>
				</ul>
			</form>
		</div>
		<div>
			<button class="btn">Standaardwaarden herstellen</button>
			<a href="" class="cancel">Annuleren</a>
		</div>
	</main>
@stop