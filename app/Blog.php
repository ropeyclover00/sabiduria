<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
	protected $fillable = ['name', 'content', 'slug', 'status', 'author', 'image_id', 'category_id', 'subcategory_id'];

	public function category()
	{
		$this->belongsTo("App\Category");
	}

	public function subcategory()
	{
		$this->belongsTo("App\Category");
	}

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function comments()
    {
    	return $this->morphMany(Comment::class, 'commentable');
    }

    public function author()
    {
    	return $this->belongsTo('App\User');
    }

    public function getAuthorNameAttribute()
    {
    	return "{$this->author->name} {$this->author->last_name}";
    }

    public function tags()
    {
    	return $this->morphToMany(Tag::class, 'taggable');
    }

    public function getCategoryNameAttribute()
    {
    	return $this->category->name;
    }

    public function getSubcategoryNameAttribute()
    {
    	return $this->category->name;
    }

    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = Str::slug($value);
    }
}
