<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Files;

class Editorial extends Model
{
    protected $fillable = ['name', 'address', 'phone', 'email', 'url', 'country_id'];

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
}
