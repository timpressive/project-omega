@extends('layout.main')
@section('title', 'Authenticatie')
@section('content')
<div class="starter-template">
	<div class="biohazard"><img src="{{ asset('img/biohazard.png' )}}" alt=""></div>
	<h1 class="text-center">PROJECT OMEGA</h1>
	<p class="lead text-center">toegangscode vereist</p>
	
	@include('partial.error')
	<form id="auth" method="POST" action="auth/access">
		{{ csrf_field() }}
		<input type="text" class="form-control" name="code">
		<button type="submit" class="submit">CONTROLEREN</button>
	</form>
</div>
@stop