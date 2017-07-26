<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Manga;
use App\Category;
use App\Artist;
Use App\Author;

class MangaController extends Controller
{
    public function adminIndex()
    {
    	$mangas = Manga::all();
    	return view('admin.manga.index', ['mangas' => $mangas]);
    }

    public function adminShowManga($slug)
    {
        try {
            $manga = Manga::with(['chapters', 'genres', 'authors', 'artists'])->where('slug', $slug)->firstOrFail();
            return view('admin.manga.show', compact('manga'));
        } catch (\ModelNotFoundException $e) {
            abort(404);
        }
    	
    }

    public function adminCreateManga()
    {
        $categories = Category::all();
        $artists = Artist::all();
        $authors = Author::all();

        return view('admin.manga.create', compact('categories', 'artists', 'authors'));
    }

    public function adminStoreManga()
    {
        $this->validate(request(), [
            'name' => 'required|unique:mangas|max:255',
            'year_released' => 'numeric',
            'cover_path' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

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

    public function adminEditManga($slug)
    {

        try {
            $manga = Manga::where('slug', $slug)->firstOrFail();
            return view('admin.manga.edit', compact('manga'));
        } catch (\ModelNotFoundException $e) {
            abort(404);
        }

        
    }

    public function adminUpdateManga($slug)
    { 

        $this->validate(request(), [
            'name' => 'required'
        ]);

        try {
            $manga = Manga::where('slug', $slug)->firstOrFail();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
        
        $newName = request('name');

        if ($manga->name != request('name')) {
            $this->validate(request(), [
                'name' => 'unique:mangas'
            ]);

            $manga->fill([
                'name' => $newName,
                'slug' => $newName
            ]);
        }

        $manga->description = request('description');
        $manga->save();

        return redirect()->route('admin.show.manga', ['slug' => $manga->slug]);
        
    }

    public function adminDeleteManga($slug)
    {
        try {

            $manga = Manga::where('slug', $slug)->firstOrFail();     
            
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }

        $manga->authors()->detach();
        $manga->artists()->detach();
        $manga->genres()->detach();
        $manga->delete();

        Storage::deleteDirectory('public/manga/'. $manga->id);
        Storage::delete('public/covers/' . $manga->cover);

        return response()->json('Success', 200);

    }

}
