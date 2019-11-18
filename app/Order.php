<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total', 'shipping_cost', 'status', 'street', 'between_streets', 'num_ext', 'num_int', 'neighborhood', 'postal_code', 'state_id', 'city_id'];

    public function details()
    {
    	return $this->hasMany('App\OrderDetail');
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function state()
    {
    	return $this->belongsTo('App\State');
    }

    public function city()
    {
    	return $this->belongsTo('App\City');
    }

    public function state()
    {
    	return $this->belongsTo('App\State');
    }

    public function getStateNameAttribute()
    {
    	return $this->state->name;
    }

    public function getCityNameAttribute()
    {
    	return $this->city->name;
    }

    public function getClientNameAttribute()
    {
    	return "{$this->user->name} {$this->user->last_name}";
    }
}
