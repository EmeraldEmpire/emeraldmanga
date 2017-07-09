@extends('layouts.app')

@section('content')
	<section class="container">
		<h2>{{ strtoupper($manga->name) }}</h2>
		<br>
		<form action="{{ route('admin.store.chapter', ['$slug' => $manga->slug]) }}" method="POST" enctype="multipart/form-data">

			{{ csrf_field() }}

			<div class="form-group">
				<label for="chapter_title">Chapter Title</label>
				<input type="text" name="chapter_title" id="chapter_title" class="form-control" placeholder="Optional">
			</div>

			<div class="form-group">
				<label for="chap_num">Chapter Number</label>
				<input type="number" name="chap_num" id="chapter_num" class="form-control">
			</div>

			<div class="form-group">
				<label for="img_path">Chapter Page Images</label>
				<input type="file" name="img_path[]" multiple class="form-control">
			</div>

			<button type="submit" class="btn btn-success">Upload !</button>
		</form>
	</section>
@endsection