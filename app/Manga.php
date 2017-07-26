<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Manga\Relationships;

class Manga extends Model
{
    use Relationships;

    protected $fillable = [
    	'name', 
    	'description', 
    	'year_released', 
    	'is_completed', 
    	'cover_path', 
    	'slug'
    ];

    public function setSlugAttribute($value) {
        $this->attributes['slug'] = str_slug($value);
    }

    public function getCoverPathAttribute($value)
    {
        if (!$value) {
            return \Storage::url('defaults/avatar2.png');
        }

        return \Storage::url($value);
    }
}
