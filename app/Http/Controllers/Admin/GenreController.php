<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Genre;

class GenreController extends Controller
{
    public function index()
    {
    	$genres = Genre::all();

    	return view('admin.genre.index', compact('genres'));
    }

    public function store()
    {
    	$this->validate(request(), [
    		'name' => 'required|unique:genres'
    	]);

    	$genre = Genre::create(request(['name']));

    	return response()->json($genre, 201);
    }

    public function update($genre)
    {
    	$this->validate(request(), [
    		'name' => 'required|unique:genres'
    	]);

    	try {
    		$genre = Genre::findOrFail($genre);
    		$genre->update(request(['name']));
    		return response()->json($genre, 200);
    	} catch (\Exception $e) {
    		return response()->json($e->getMessage(), 404);
    	}
    }

    public function destroy($genre)
    {
    	try {
    		$genre = Genre::findOrFail($genre);
    		
    	} catch (\Exception $e) {
    		return response()->json($e->getMessage(), 404);
    	}

    	if (!$genre->delete()) {
			return response()->json('Fail', 500);
		}

		return response()->json('Success', 200);

    }

}
