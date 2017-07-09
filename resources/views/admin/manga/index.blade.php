@extends('layouts.app')

@section('content')

	<section class="container">
		<a href="{{ route('admin.create.manga') }}" class="btn btn-default">Add New Manga</a>
		<br>
		<br>
		<table class="table table-bordered">
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Year Released</th>
				<th>Completed</th>
			</tr>
			@foreach ($mangas as $manga)
				<tr>
					<td><a href="{{ route('admin.show.manga', ['slug' => $manga->slug]) }}">{{ strtoupper($manga->name) }}</a></td>
					<td>{{ $manga->description }}</td>
					<td>{{ $manga->year_released }}</td>
					<td>{{ $manga->is_completed ? 'Completed' : 'Ongoing' }}</td>
				</tr>
			@endforeach
		</table>
	</section>
	
@endsection