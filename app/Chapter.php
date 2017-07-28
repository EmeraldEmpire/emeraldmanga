<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{   
    protected $appends = ['href'];
    
    protected $fillable = [
        'manga_id', 
        'chapter_title', 
        'chapter_num', 
        'num_slug'
    ];

    public function pages()
    {
    	return $this->hasMany('App\Page');
    }

    public function manga()
    {
        return $this->belongsTo('App\Manga');
    }

    public function setNumSlugAttribute($value)
    {	
    	$num = (string)$value;

    	if (strlen($num) < 2 ) {
    		return $this->attributes['num_slug'] = 'c00'.$num;
    	}
    	if (strlen($num) < 3) {
    		return $this->attributes['num_slug'] = 'c0'.$num;
    	}
    	return $this->attributes['num_slug'] = 'c'.$num;
    }

    public function getHrefAttribute()
    {
        return route('admin.show.chapter', ['manga' => $this->manga_id, 'chapter' => $this->id]);
    }

}
