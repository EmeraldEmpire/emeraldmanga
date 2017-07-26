<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{   
    protected $fillable = ['manga_id', 'chapter_title', 'chap_num', 'num'];

    public function pages()
    {
    	return $this->hasMany('App\Page');
    }

    public function manga()
    {
        return $this->belongsTo('App\Manga');
    }

    public function setNumAttribute($value)
    {	
    	$num = (string)$value;

    	if (strlen($num) < 2 ) {
    		return $this->attributes['num'] = 'c00'.$num;
    	}
    	if (strlen($num) < 3) {
    		return $this->attributes['num'] = 'c0'.$num;
    	}
    	return $this->attributes['num'] = 'c'.$num;
    }

}
