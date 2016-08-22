@extends('layout.admin')
@section('title', 'Settings')
@section('content')
	<main class="settings">
		<h2>INSTELLINGEN</h2>
		<div>
			<h4>Codes wijzigen</h4>
			<form action="admin/game/setcodes" method="POST">
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
			<h4>Console opties</h4>
			<p class="alert-warning">OPGEPAST! Het wijzigen van de memo tekst en/of het console commando kunnen het spel breken. Het is zeer belangrijk dat deze twee op elkaar zijn afgestemd (zie voorbeeld of spelfiche).</p>
			<form action="admin/game/setconsole" method="POST">
				{{csrf_field()}}
				<ul>
					<li>
						<label for="console-pass">Wachtwoord console</label><br>
						<input id="console-pass" type="text" name="console-pass" placeholder="password" value="{{ $settings['console-pass'] }}">
					</li>
					<li>
						<label for="console-command">Console commando</label><br>
						<input id="console-command" type="text" name="console-command" placeholder="exec protocol 66" value="{{ $settings['console-command'] }}">
					</li>
					<li>
						<label for="memo">Memo tekst</label>
						<textarea id="memo" name="memo" cols="30" rows="10">{{ $settings['memo'] }}</textarea>
					</li>
					<button type="submit" class="btn btn-submit">Opslaan</button>
					<button type="submit" class="btn pull-right" form="reset-console">Standaardwaarden herstellen</button>
				</ul>
			</form>
			<form id="reset-console" action="admin/game/resetconsole" method="POST">
				{{csrf_field()}}
			</form>
		</div>
		<div>
			<h4>Spelduur instellen</h4>
			<form id="time" action="admin/game/setduration" method="POST">
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
	</main>
@stop
