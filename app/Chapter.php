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

}
