@extends('layout.main')
@section('title', 'Pincode vereist')
@section('content')
	<div id="pin">
		<main>
			<h2>Pincode vereist.</h2>
			<h4>Geef de pincode in op het toestel om de console vrij te geven.</h4>
			<p>Druk op # om te corrigeren.</p>
			<div class="success">
				<h3>Pin code correct!</h3>
				<a class="ok" href="console">Ga verder</a>
			</div>
		</main>
	</div>
@stop

@section('js')
	<script>
		$(function (e) {
			$('.success').hide();
			$.get('ajax/keypad', function (data) {
				if (data) {
					$('.success').show();
				}
			});
		});
	</script>
@stop
