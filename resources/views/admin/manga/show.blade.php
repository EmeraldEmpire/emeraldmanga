@extends('layouts.app')

@section('content')
	<section class="container">
		<a href="{{ route('admin.home') }}" class="btn btn-default">Home</a><br><br>
		<a href="{{ route('admin.upload.chapter', ['slug' => $manga->slug]) }}" class="btn btn-success">Add Chapter</a>
		<h2>{{ strtoupper($manga->name) }}</h2>
		<h4>Genre(s): 
			@foreach($manga->categories as $category)
				<small>{{  $category->name }}</small>
			@endforeach
		</h4>
		<h4>Author(s): 
			@foreach($manga->authors as $author)
				<small>{{ $author->name }}</small>
			@endforeach
		</h4>
		<h4>Artist(s): 
			@foreach($manga->artists as $artist)
				<small>{{ $artist->name }}</small>
			@endforeach
		</h4>
		<h4>Status: <small>{{ $manga->is_completed ?  'Completed' : 'Ongoing' }}</small></h4>
		<h4>Description: </h4>
		<p>{{ $manga->description ?: 'No Description'}}</p>

		<h3>Chapter List</h3>
		<ul>
			@foreach($manga->chapters as $chapter)
				<li><a href="{{ route('admin.view.thumb', ['slug' => $manga->slug, 'cnum' => $chapter->num]) }}">{{ $chapter->num }}</a></li>
			@endforeach
		</ul>
	</section>
	
@endsection