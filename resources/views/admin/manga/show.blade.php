@extends('layouts.app')

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')
	<manga-show :store-manga="{{ $manga }}"
		:genres="{{ $genres }}"
		:authors="{{ $authors }}"
		:artists="{{ $artists }}"></manga-show>
@endsection

@section('scripts')
	<script src="{{ asset('js/sweetalert.min.js') }}" ></script>
@endsection