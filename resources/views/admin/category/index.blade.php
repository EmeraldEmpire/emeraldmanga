@extends('layouts.app')

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')

	<Categories :cats="{{ $categories }}"></Categories>

@endsection

@section('scripts')
	<script src="{{ asset('js/sweetalert.min.js') }}" ></script>
@endsection