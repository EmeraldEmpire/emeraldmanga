@extends('layouts.app')

@section('content')

	<section class="container">
		<h1>Add New Category</h1>

		<form action="{{ route('admin.store.categories') }}" method="POST">

			{{ csrf_field() }}
			
			<div class="form-group">
				<label for="name">Category Name</label>
				<input type="text" name="name" id="name" class="form-control">
			</div>

			<button type="submit" class="btn btn-success">Submit</button>
		</form>
	</section>
@endsection