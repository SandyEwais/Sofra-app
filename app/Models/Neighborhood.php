<?php

namespace App\Models;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model 
{
    use Searchable;

    protected $table = 'neighborhoods';
    public $timestamps = true;
    protected $fillable = array('name', 'city_id');

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }

    public function restaurants()
    {
        return $this->hasMany('App\Models\Restaurant');
    }

}