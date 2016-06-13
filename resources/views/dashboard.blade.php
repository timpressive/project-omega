@extends('layout.admin')
@section('title', 'Home')
@section('content')		
	<div class="row">
		<a href="{{ route('code.edit') }}" class="btn-primary">Code wijzigen</a>
	</div>
	<div class="row">
		<a href="{{ route('lock.index') }}" class="btn-primary">Slot beheren</a>
	</div>
@stop
