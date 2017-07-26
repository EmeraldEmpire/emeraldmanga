<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Manga;
use App\Chapter;
use App\Page;

class ChapterController extends Controller
{
    public function adminViewThumb($slug, $cnum)
    {   
        $manga = Manga::where('slug', $slug)->first();
        $chapter = $manga->chapters()->where('num', $cnum)->first();
        return view('admin.manga.chapter.show', compact('manga', 'chapter'));
    }

    public function AdminCreateChapter($slug)
    {
        try {
            $manga = Manga::where('slug', $slug)->firstOrFail();
            return view('admin.manga.chapter.create', compact('manga'));
        } catch (\ModelNotFoundException $e) {
            
        }
    }

    public function AdminStoreChapter($slug)
    {
    	$this->validate(request(), [
    		'chap_num' => 'required|numeric|max:9999',
            'img' => 'required',
            'img.*' => 'image|mimes:jpeg,png,jpg|max:2048'
    	]);

        try {
            $manga = Manga::where('slug', $slug)->firstOrFail();
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    	
    	$chapter = $manga->chapters()->create([
    		'chapter_title' => request('chapter_title'),
    		'chap_num' => request('chap_num'),
    		'num' => request('chap_num')
    	]);

    	$images = request('img');
    	$pages = [];
        

    	foreach ($images as $key => $image) {
            $imageName = $image->getClientOriginalName();
            $path = $manga->id . '/' . $chapter->id . '/' . $imageName;
            $image->storeAs('public/manga/'.$manga->id.'/'.$chapter->id, $imageName);
            $pageNum = ++$key;
    		array_push($pages, ['img_path' => $path, 'page_num' => $pageNum]);
    	}

        $chapter->pages()->createMany($pages);

        return response()->json($chapter->load('pages'), 201);

    }

    public function adminDeleteChapter($slug, $cnum)
    {
        try {
            $manga = Manga::where('slug', $slug)->firstOrFail();
            $chapter = $manga->chapters()->where('num', $cnum)->firstOrFail();
            $chapter->delete();

            Storage::deleteDirectory('public/manga/' . $manga->id . '/' . $chapter->id);

            return response()->json('success', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 404);
        }
    }

}
