@extends('layout.main')
@section('title', 'Overzicht')
@section('content')
<div id="overview">
	<main>
		<div class="row">
			<div class="col-md-4 profile">
				<img src="{{ asset('img/profile.png') }}" alt="profile">
				<div class="ident">
					<h5>P. SELIE</h5>
					<h5>ID: 7224</h5>
					<h5>LAATST ONLINE: <span class="red">ONBEKEND</span></h5>
				</div>
			</div>
			<div class="col-md-8">
				<h1>OVERZICHT</h1>
				<p>
					Dit is het besturingspaneel voor Project Omega. Hierlangs wordt al het onderhoud uitgevoerd.<br>
					Voor hulp: neem contact op met de technische dienst.
				</p>
				<p>Grote veranderingen en interacties gebeuren via de <a class="console" href="console">console</a>.</p>
			</div>	
		</div>

		<h2>STATUS</h2>
		<div class="row">
			<div class="col-md-4 statbars">
				<div class="progress">
					<div class="progress-bar"></div>
				</div>
				<div class="progress">
					<div class="progress-bar"></div>
				</div>
				<div class="progress">
					<div class="progress-bar"></div>
				</div>
			</div>
			<div class="col-md-6">
				@include('partial.equalizer')
			</div>
			<div class="col-md-2 stats">
				<p><i class="fa fa-flash"></i><span class="green pull-right">1.5W</span></p>
				<p><i class="fa fa-lock"></i> <span class="green pull-right">99.98%</span></p>
				<p><i class="fa fa-shield"></i><span class="green pull-right">100%</span></p>
			</div>
		</div>
	</main>
</div>
@stop

@section('js')
	<script src="{{ asset('js/equalizer.js') }}"></script>
@stop
