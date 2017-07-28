<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Manga;
use App\Genre;
use App\Author;
use App\Artist;

class MangaController extends Controller
{
	public function index()
    {
    	$mangas = Manga::latest()->get();
    	return view('admin.manga.index', ['mangas' => $mangas]);
    }

    public function show($manga)
    {
        try {
            $manga = Manga::with(['chapters' => function ($query) {
                $query->latest();
            }, 'genres', 'authors', 'artists'])->findOrFail($manga);
            $genres = Genre::all();
            $authors = Author::all();
            $artists = Artist::all();
            return view('admin.manga.show', compact('manga', 'genres', 'authors', 'artists'));
        } catch (\ModelNotFoundException $e) {
            abort(404);
        }
    	
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|unique:mangas|max:255',
            'cover_path' => 'image|mimes:jpeg,png,jpg|max:2048',
            'is_completed' => 'required|boolean'
        ]);

        if (request('year_released')) {
            $this->validate(request(), [
                'year_released' => 'numeric'
            ]);
        }

        $manga = new Manga(request([
            'name',
            'description',
            'year_released',
            'is_completed'
        ]));

        
        if (request()->hasFile('cover')) {
            $path = pathinfo(request('cover')->store('public/covers'), PATHINFO_BASENAME);
            $manga->cover = $path;
        }

        $manga->slug = request('name');
        $manga->save();
        
        Storage::makeDirectory('public/manga/'.$manga->id);

        if ($genres = request('genres')) {
            $manga->genres()->attach($genres);
        }
        if ($authors = request('authors')) {
            $manga->authors()->attach($authors);
        }
        if ($artists = request('artists')) {
            $manga->artists()->attach($artists);
        }
         

        return response()->json($manga, 201);
    }

    public function update($manga)
    { 

        $this->validate(request(), [
            'name' => 'required'
        ]);

        try {
            $manga = Manga::findOrFail($manga);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
        
        $newName = request('name');

        if ($manga->name != $newName) {
            $this->validate(request(), [
                'name' => 'unique:mangas'
            ]);

            $manga->fill([
                'name' => $newName,
                'slug' => $newName
            ]);
        }

        $genres = request('genres');
        $authors = request('authors');
        $artists = request('artists');

        $manga->genres()->sync($genres);
        $manga->authors()->sync($authors);
        $manga->artists()->sync($artists);

        $manga->description = request('description');
        $manga->save();

        $manga = $manga->load(['chapters' => function ($query) {
            $query->latest();
        }, 'genres', 'authors', 'artists']);

        return response()->json($manga, 200);
        
    }

    public function destroy($manga)
    {
        try {
            $manga = Manga::findOrFail($manga);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }

        $manga->authors()->detach();
        $manga->artists()->detach();
        $manga->genres()->detach();
        $manga->delete();

        Storage::deleteDirectory('public/manga/'. $manga->id);

        if ($manga->cover) {
            Storage::delete('public/covers/' . $manga->cover);
        }
        
        return response()->json('Success', 200);

    }
}