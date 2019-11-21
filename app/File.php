<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $fillable = ['mime', 'original', 'hash', 'size', 'key', 'disk'];

    public function fileable()
    {
    	return $this->morphTo();
    }
}
