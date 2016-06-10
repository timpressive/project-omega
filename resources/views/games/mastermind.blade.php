@extends('layout.main')
@section('title', 'Level 1')
@section('content')
	<h2 class="text-center">DECRYPTIE: NIVEAU {{ $level }}</h2>
	<div id="mastermind" class="container">
		<h4 id="portrait-label">Dit deel is enkel beschikbaar in landschapsmodus (draai het toestel 90°)</h4>
		<div class="attempts"></div>
		<div class="row controls">
			<div class="colors">
				<?php for($i = 0; $i < 2 + (2 * $level); $i++): ?>
					<i class="fa fa-circle fa-4x"></i>
				<?php endfor; ?>
			</div>
			<div class="verify">
				<div class="row">
					<?php $length = 2 + (2 * $level);?>
					<?php for($i = 1; $i <= $length; $i++): ?>
						<div class="color"><i class="fa fa-circle"></i></div>
					<?php endfor; ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p class="message"></p>
				<a href="{{ $redirect }}" class="proceed btn btn-success">Ga verder >></a>
				<button id="check" class="btn btn-primary">Nakijken</button>
			</div>
		</div>
	</div>
@stop
@section('js')
	<script>var level = parseInt("{{ $level }}");</script>
	<script src="{{ asset('js/mastermind.js') }}"></script>
@stop