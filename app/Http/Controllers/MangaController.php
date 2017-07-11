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
    	$manga = Manga::where('slug', $slug)->first();

    	return view('admin.manga.show', compact('manga'));
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
            'name' => 'required|max:255',
        ]);

        $slug = str_slug(request('name'));

        if (Manga::where('slug', $slug)->exists()) {
            return back();
        }

        $manga = new Manga(request([
            'name',
            'description', 
            'year_released', 
            'is_completed'
        ]));

        $manga->slug = $slug;
        $manga->save();

        Storage::makeDirectory('public/manga/'.$manga->slug);

        if ($categories = request('categories')) {
            $manga->categories()->attach($categories);
        }
        if ($authors = request('authors')) {
            $manga->authors()->attach($authors);
        }
        if ($artists = request('artists')) {
            $manga->artists()->attach($artists);
        }
         

        return response(['manga' => $manga, 'categories' => $categories, 'authors' => $authors, 'artists' => $artists]);
    }

    public function adminEditManga($slug)
    {
        if (!$manga = Manga::where('slug', $slug)->first()) {
            return back();
        }

        return view('admin.manga.edit', compact('manga'));
    }

    public function adminUpdateManga($slug)
    {
        $this->validate(request(), [
            'name' => 'required'
        ]);

        $newSlug = str_slug(request('name'));

        if (Manga::where('slug', $newSlug)->exists()) {
            return back();
        }

        if (!$manga = Manga::where('slug', $slug)->first()) {
            return back();
        }

        $manga->update([
            'name' => request('name'),
            'description' => request('description'),
            'slug' => $newSlug
        ]);

        return $manga;
    }

    public function adminDeleteManga($slug)
    {
        if (!$manga = Manga::where('slug', $slug)->first()) {
            return back();
        }

        $manga->authors()->detach();
        $manga->artists()->detach();
        $manga->categories()->detach();
        $manga->delete();

        Storage::deleteDirectory('public/manga/'.$slug);

        return redirect()->route('admin.home');
    }

}
