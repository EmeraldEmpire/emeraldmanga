<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;

class GenreController extends Controller
{
    public function adminIndexGenre()
    {
    	$genres = Genre::all();

    	return view('admin.genre.index', compact('genres'));
    }

    public function adminStoreGenre()
    {
    	$this->validate(request(), [
    		'name' => 'required|unique:genres'
    	]);

    	$genre = Genre::create(request(['name']));

    	return response()->json($genre, 201);
    }

    public function adminUpdateGenre($id)
    {
    	$this->validate(request(), [
    		'name' => 'required|unique:genres'
    	]);

    	try {
    		$genre = Genre::findOrFail($id);
    		$genre->update(request(['name']));
    		return response()->json($genre, 200);
    	} catch (\Exception $e) {
    		return response()->json($e->getMessage(), 404);
    	}
    }

    public function adminDeleteGenre($id)
    {
    	try {
    		$genre = Genre::findOrFail($id);
    		
    	} catch (\Exception $e) {
    		return response()->json($e->getMessage(), 404);
    	}

    	if (!$genre->delete()) {
			return response()->json('Fail', 500);
		}

		return response()->json('Success', 200);

    }

}
