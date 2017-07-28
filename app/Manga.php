<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Manga\Relationships;

class Manga extends Model
{
    use Relationships;

    protected $appends = [
        'cover_path',
        'href',
        ];

    protected $fillable = [
    	'name', 
    	'description', 
    	'year_released', 
    	'is_completed', 
    	'cover', 
    	'slug'
    ];

    public function setSlugAttribute($value) {
        $this->attributes['slug'] = str_slug($value);
    }

    public function getCoverPathAttribute()
    {   
        $coverPath = $this->cover;

        if (!$coverPath) {
            return \Storage::url('defaults/avatar2.png');
        }

        return \Storage::url('public/covers/' . $coverPath);
    }

    public function getHrefAttribute()
    {
        return route('admin.show.manga', ['manga' => $this->id]);
    }
    
}
