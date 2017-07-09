<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    protected $fillable = ['name', 'description', 'year_released', 'is_completed', 'cover_path', 'slug'];

    public function chapters()
    {
    	return $this->hasMany('App\Chapter');
    }

    public function categories()
    {
    	return $this->belongsToMany('App\Category');
    }

    public function authors()
    {
    	return $this->belongsToMany('App\Author');
    }

    public function artists()
    {
    	return $this->belongsToMany('App\Artist');
    }
}
