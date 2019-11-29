<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['price', 'quantity', 'product_id', 'order_id'];

    public function order()
    {
    	return $this->belongsTo(Order::class);
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function getPriceFormatAttribute()
    {
        return "$" . number_format((float) $this->price, 2, '.',',') . " MXN";
    }

    public function getTotalFormatAttribute()
    {
    	return "$" . number_format((float) ($this->price * $this->quantity), 2, '.',',') . " MXN";	
    }
}
