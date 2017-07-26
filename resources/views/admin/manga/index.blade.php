@extends('layouts.app')

@section('stylesheets')
	<link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')

	<manga-list :store-mangas="{{ $mangas }}"
		:authors="{{ $authors }}"
		:artists="{{ $artists }}"></manga-list>

@endsection

@section('scripts')
	<script src="{{ asset('js/sweetalert.min.js') }}" ></script>
@endsection