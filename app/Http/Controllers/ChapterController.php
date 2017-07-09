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

    public function AdminUploadChapter($slug)
    {
    	$manga = Manga::where('slug', $slug)->first();

    	return view('admin.manga.chapter.create', compact('manga'));
    }

    public function AdminStoreChapter($slug)
    {
    	$this->validate(request(), [
    		'chap_num' => 'required|numeric|max:9999',
            'img_path' => 'required'
    	]);

    	$manga = Manga::where('slug', $slug)->first();
    	$chapter = $manga->chapters()->create([
    		'chapter_title' => request('chapter_title'),
    		'chap_num' => request('chap_num'),
    		'num' => 'c'.(string)request('chap_num')
    	]);

    	$images = request('img_path');
    	$insertImages = [];
        

    	foreach ($images as $image) {
            $path = $image->storeAs('public/manga/'.$manga->slug.'/'.$chapter->num, $image->getClientOriginalName());
            $pageNum = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
    		array_push($insertImages, new Page(['img_path' => $path, 'page_num' => $pageNum]));
    	}

        $pages = $chapter->pages()->saveMany($insertImages);
    }
}
