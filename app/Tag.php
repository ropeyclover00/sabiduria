<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = ['name', 'description', 'slug'];

    public function blogs()
    {
    	return $this->morphedByMany(Blog::class, 'taggable');
    }

    public function products()
    {
    	return $this->morphedByMany(Product::class, 'taggable');
    }

    public function setSlugAttribute($value)
    {
    	$this->attributes['slug'] = Str::slug($value);
    }

    public function getProductsStringAttribute()
    {
        $products = "N/A";

        if(count($this->products))
        {
            $products = "";
            foreach ($this->products as $product) 
                $products .= $product->name . ", ";
        
            $products =  substr($products, 0, strlen($products) - 2);    
        }

        return $products;
    }

    public function getBlogsStringAttribute()
    {
        $blogs = "N/A";

        if(count($this->blogs))
        {
            $blogs = "";
            foreach ($this->blogs as $blog) 
                $blogs .= $blog->name . ", ";
        
            $blogs =  substr($blogs, 0, strlen($blogs) - 2);    
        }

        return $blogs;
    }

}
