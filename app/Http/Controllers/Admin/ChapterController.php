<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Manga;
use App\Chapter;
use App\Page;

class ChapterController extends Controller
{
    public function index($manga, $chapter)
    {   
        $manga = Manga::findOrFail($manga);
        $chapter = $manga->chapters()->findOrFail($chapter);
        return view('admin.manga.chapter.show', compact('manga', 'chapter'));
    }

    public function store($manga)
    {
    	$this->validate(request(), [
    		'chapter_num' => 'required|numeric|max:9999',
            'img' => 'required',
            'img.*' => 'image|mimes:jpeg,png,jpg|max:2048'
    	]);

        try {
            $manga = Manga::findOrFail($manga);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }

        //unique num slug
    	
    	$chapter = $manga->chapters()->create([
    		'chapter_title' => request('chapter_title'),
    		'chapter_num' => request('chapter_num'),
    		'num_slug' => request('chapter_num')
    	]);

    	$images = request('img');
    	$pages = [];
        

    	foreach ($images as $key => $image) {
            $imageName = $image->getClientOriginalName();
            $path = $manga->id . '/' . $chapter->id . '/' . $imageName;
            $image->storeAs('public/manga/' . $manga->id . '/' . $chapter->id, $imageName);
            $pageNum = ++$key;
    		array_push($pages, ['img' => $path, 'page_num' => $pageNum]);
    	}

        $chapter->pages()->createMany($pages);

        return response()->json($chapter, 201);

    }

    public function destroy($manga, $chapter)
    {
        try {
            $manga = Manga::findOrFail($manga);
            $chapter = $manga->chapters()->findOrFail($chapter);
            $chapter->delete();

            Storage::deleteDirectory('public/manga/' . $manga->id . '/' . $chapter->id);

            return response()->json('success', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

}
