@extends('layout.main')
@section('title', 'Authenticatie')
@section('content')
<main id="home">
	<img id="logo" src="{{ asset('img/name-white.png') }}" alt="logo">
	<h3 class="text-center">TOEGANGSCODE VEREIST</h3>

	<form id="auth" method="POST" action="auth/access">
		@include('partial.error')
		{{ csrf_field() }}

		<i class="toggle-visible fa fa-eye"></i>
		<input type="password" class="form-control" name="code" placeholder="Geef code in...">
		<button type="submit" class="submit"><i class="fa fa-chevron-right"></i></button>
	</form>
</main>
@stop
@section('js')
	<script>
		$('.toggle-visible').click(function() {
			$('.toggle-visible')
				.toggleClass('fa-eye')
				.toggleClass('fa-eye-slash');
			if ($('#auth input[name="code"]').attr('type') == 'password') { $('#auth input[name="code"]').attr('type', 'text'); }
			else { $('#auth input[name="code"]').attr('type', 'password'); }
		});
	</script>
@stop
