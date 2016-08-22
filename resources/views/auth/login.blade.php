@extends('layout.admin')
@section('title', 'Login')
@section('content')
	<h2>Aanmelden als spelleider</h2>
	<form id="login" method="POST" action="login">
		<div class="row">
			<div class="form-group">
				<input type="text" name="username" placeholder="Gebruikersnaam">
			</div>
			<div class="form-group">
				<input type="password" name="password" placeholder="Wachtwoord">
				{{ csrf_field() }}
			</div>
			<button class="btn btn-submit">Aanmelden</button>
		</div>
	</form>
@stop