<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Files;

class User extends Authenticatable
{
    use Notifiable;
    private $roles = [1=>'Cliente', 2=>'Administrador'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'rol', 'last_name', 'address', 'interior_number', 'exterior_number', 'suburb', 'between_streets', 'postal_code', 'phone', 'cellphone', 'city_id', 'state_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function blogs()
    {
        return $this->hasMany('App\Blog');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->last_name}";
    }

    public function getRolNameAttribute()
    {
        return $this->roles[$this->rol];
    }

    public function getFormalNameAttribute()
    {
        return "{$this->last_name}, {$this->name}";
    }

    public function getStateNameAttribute()
    {
        return $this->state->name;
    }

    public function getCityNameAttribute()
    {
        return $this->state->name;
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
    
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
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
