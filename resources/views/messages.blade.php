@extends('layout')

@section('body')

	@if (session('success'))
		<div data-alert class="alert-box success radius">{{ session('success') }}<a href="#" class="close">&times;</a></div>
	@endif

	@if ( ! $messages->count())
		<div data-alert class="alert-box info radius">No messages found<a href="#" class="close">&times;</a></div>
	@else
		@include('partials.table')
	@endif

	<div class="text-center"><a href="/" class="button">Refresh</a></div>

	@include('partials.form')

@stop
