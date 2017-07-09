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
        $manga = new Manga(request(['name', 'description', 'year_released', 'is_completed']));
        $manga->slug = str_slug(request('name'));
        Storage::makeDirectory('public/manga/'.$manga->slug);
        $manga->save();
        $manga->categories()->attach(request('categories'));
        $manga->authors()->attach(request('authors'));
        $manga->artists()->attach(request('artists'));

        return $manga;
    }

}
