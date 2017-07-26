<?php

namespace App\Traits\Manga;

Trait Relationships {

	public function chapters()
	{
		return $this->hasMany('App\Chapter');
	}

    public function genres()
    {
    	return $this->belongsToMany('App\Genre');
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