@extends('layouts.app')

@section('content')
	<section class="container">
		<h1>{{ $manga->name }}</h1>
		<h2>{{ $chapter->num }}</h2>
		@foreach ($chapter->pages as $page)
			<img src="{{ Storage::url('manga/'.$page->img_path) }}" class="col-md-3" style="max-width:150px; max-height:150px; margin-top:20px;" alt="">
		@endforeach
	</section>
	
@endsection