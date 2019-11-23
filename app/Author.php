<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Files;

class Author extends Model
{
    protected $fillable = ['name', 'last_name', 'country_id', 'birthday', 'email', 'address'];

    protected $dates = ['birthday'];

    public function country()
    {
    	return $this->belongsTo('App\Country');
    }

    public function products()
    {
    	return $this->belongsToMany('App\Product');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function getImageAttribute()
    {
    	return $this->files[0] ?? null;
    }

    public function getImgUrlAttribute()
    {
    	$url = "";
    	
    	if($this->image)
            $url = Files::getUrl($this->image->id);

        return $url;
    }

    public function getFullNameAttribute()
    {
    	return "{$this->name} {$this->last_name}";
    }
}
