@extends('layouts.app')

@section('content')

	<section class="container">
		<form action="{{ route('admin.store.manga') }}" method="POST" enctype="multipart/form-data">

			{{ csrf_field() }}
		
			<div class="form-group">
				<label for="name">Manga Name / Title</label>
				<input class="form-control" type="text" name="name" id="name">
			</div>

			<div class="form-group">
				<label for="description">Description / Synopsis</label>
				<textarea class="form-control" name="description" id="description"></textarea>
			</div>

			<div class="form-group">
				<label for="categories">Genre(s)</label>
				<select id="categories" name="categories[]" multiple="multiple" class="form-control select2-multi">
				  	@foreach($categories as $category)
				  		<option value="{{ $category->id }}">{{ $category->name }}</option>
				  	@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="authors">Author(s)</label>
				<select id="authors" name="authors[]" multiple="multiple" class="form-control select2-multi">
					@foreach($authors as $author)
					  		<option value="{{ $author->id }}">{{ $author->name }}</option>
				  	@endforeach
			  	</select>
			</div>

			<div class="form-group">
				<label for="artists">Artist(s)</label>
				<select id="artists" name="artists[]" multiple="multiple" class="form-control select2-multi">
					@foreach($artists as $artist)
					  		<option value="{{ $artist->id }}">{{ $artist->name }}</option>
				  	@endforeach
			  	</select>
			</div>	

			<div class="form-group">
				<label for="year_released">Year Released</label>
				<input type="text" name="year_released" id="year_released" placeholder="ex: 2007" class="form-control">
			</div>

			<div class="form-group">
				<label for="is_completed">Status</label>
				<select name="is_completed" id="is_completed" class="form-control">
					<option value="0">Ongoing</option>
					<option value="1">Completed</option>
				</select>
			</div>

			<div class="form-group">
				<label for="cover_path">Cover Image</label>
				<input type="file" name="cover_path" id="cover_path" class="form-control">
			</div>

			<button type="submit" class="btn btn-default">Done !</button>

		</form>
	</section>
		
@endsection