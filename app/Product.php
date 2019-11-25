<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //add this line
use Illuminate\Support\Str;
use Files;

class Product extends Model
{
    use SoftDeletes; //add this line
    protected $dates = ['deleted_at'];
    protected $estados = ['Inactivo', 'Activo'];
    protected $fillable = ['name', 'description', 'isbn', 'year', 'price', 'stock', 'status', 'outstanding', 'category_id', 'subcategory_id', 'country_id'];

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function editorials()
    {
    	return $this->belongsToMany('App\Editorial', 'products_has_editorials', 'product_id', 'editorial_id');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function subcategory()
    {
    	return $this->belongsTo('App\Subcategory');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function authors()
    {
        return $this->belongsToMany('App\Author', 'authors_has_products', 'product_id', 'author_id');
    }

    public function tags()
    {
    	return $this->morphToMany(Tag::class, 'taggable');
    }

    public function getEstatusAttribute()
    {
        return $this->estados[$this->status];
    }

    public function getCountryNameAttribute()
    {
        return $this->country->name;
    }

    public function getCategoryNameAttribute()
    {
    	return $this->category->name;
    }

    public function getSubcategoryNameAttribute()
    {
    	return $this->subcategory->name;
    }

    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = Str::slug($value);
    }

    public function getTagsStringAttribute()
    {
        $tags = "";
        if(count($this->tags))
        {
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

    public function getEditorialsStringAttribute()
    {
        $editorials = "";
        if(count($this->editorials))
        {
            foreach ($this->editorials as $editorial) 
                $editorials .= $editorial->name . ", ";
        
            $editorials =  substr($editorials, 0, strlen($editorials) - 2);    
        }
        return $editorials;
    }

    public function getEditorialsIdsAttribute()
    {
        $ids = [];
        foreach ($this->editorials as $editorial) {
            $ids[] = $editorial->id;
        }
        return $ids;
    }

    public function getAuthorsStringAttribute()
    {
        $authors = "";
        if(count($this->authors))
        {
            foreach ($this->authors as $author) 
                $authors .= $author->full_name . ", ";
        
            $authors =  substr($authors, 0, strlen($authors) - 2);    
        }
        return $authors;
    }

    public function getAuthorsIdsAttribute()
    {
        $ids = [];
        foreach ($this->authors as $author) {
            $ids[] = $author->id;
        }
        return $ids;
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

}
