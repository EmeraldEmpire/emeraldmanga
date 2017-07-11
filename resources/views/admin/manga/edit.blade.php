@extends('layouts.app')

@section('content')

	<section class="container">

		<h1>Edit Manga</h1>

		<a href="{{ route('admin.show.manga', ['slug' => $manga->slug]) }}" class="btn btn-default" >Back</a>

		<br><br>

		<form action="{{ route('admin.update.manga', ['slug' => $manga->slug]) }}" method="POST">
			
			{{ csrf_field() }}

			<div class="form-group">
				<label for="name">Manga Name</label>
				<input name="name" id="name" type="text" class="form-control" value="{{ $manga->name }}">
			</div>

			<div class="form-group">
				<label for="description">Description / Synopsis</label>
				<textarea name="description" id="description" cols="30" rows="4" class="form-control">{{ $manga->description }}</textarea>
			</div>

			<button type="submit" class="btn btn-success">Update</button>

		</form>

		<br>

		<form action="{{ route('admin.delete.manga', ['slug' => $manga->slug]) }}" method="POST">
			<button class="btn btn-danger" type="submit">Delete Manga</button>
		</form>

	</section>


@endsection