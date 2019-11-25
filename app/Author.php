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
    	return $this->belongsToMany('App\Product', 'authors_has_products', 'author_id', 'product_id');
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
}
