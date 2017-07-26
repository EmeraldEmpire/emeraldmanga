@extends('layouts.app')

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')

	<genres :store-genres="{{ $genres }}"></genres>

@endsection

@section('scripts')
	<script src="{{ asset('js/sweetalert.min.js') }}" ></script>
@endsection