@extends('layout.main')
@section('title', 'Pincode vereist')
@section('content')
	<div id="pin">
		<main>
			<h2>Pincode vereist.</h2>
			<h4>Geef de pincode in op het toestel om de console vrij te geven.</h4>
			<p>Druk op # om te corrigeren.</p>
			<div class="success">
				<p>Pin code correct! <a href="console">Klik hier</a> om verder te gaan</p>
			</div>
		</main>
	</div>
@stop

@section('js')
	<script>
		$(function (e) {
			$('.success').hide();
			$.get('ajax/keypad', function (data) {
				console.log(data);
				if (data) {
					$('.success').show();
				}
			});
		});
	</script>
@stop
