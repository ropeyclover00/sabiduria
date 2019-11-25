<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Files;

class Blog extends Model
{
    protected $estados = ['Inactivo', 'Activo'];
	protected $fillable = ['name', 'content', 'slug', 'status', 'category_id', 'subcategory_id', 'user_id'];

    protected $dates = ['updated_at'];

	public function category()
	{
		return $this->belongsTo("App\Category");
	}

	public function subcategory()
	{
		return $this->belongsTo("App\Subcategory");
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
    	return $this->belongsTo('App\User', 'user_id');
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
    	return $this->subcategory->name;
    }

    public function getTagsStringAttribute()
    {
        $tags = "N/A";
        if(count($this->tags))
        {
            $tags = "";
            foreach ($this->tags as $tag) 
                $tags .= $tag->name . ", ";
        
            $tags =  substr($tags, 0, strlen($tags) - 2);    
        }
        return $tags;
    }

    public function getTagsIdsAttribute()
    {
        $ids = [];
        foreach ($this->tags as $tag) {
            $ids[] = $tag->id;
        }
        return $ids;
    }

    public function getEstatusAttribute()
    {
        return $this->estados[$this->status];
    }

    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = Str::slug($value);
    }

    public function getImageAttribute()
    {
        $image = null;
        
        foreach ($this->files as $key => $value) 
        {
            if(strrpos($value->mime, 'image') !== false)
            {
                $image = $value;
                break;
            }    
        }

        return $image;
    }

    public function getImgUrlAttribute()
    {
        $url = "";
        
        if($this->image)
            $url = Files::getUrl($this->image->id);

        return $url;
    }

    public function getDocumentsAttribute()
    {
        $docs = [];

        foreach ($this->files as $key => $file) {

            if(strrpos($file->mime, 'image') === false)
            {
                $docs[] = [
                    'name' => $file->name,
                    'url' => Files::getUrl($file->id),
                    'id' => $file->id
                ];
            }
        }

        return $docs;
    }
}
