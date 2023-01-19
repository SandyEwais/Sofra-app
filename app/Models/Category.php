<?php

namespace App\Models;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{
    use Searchable;

    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('name');

    public function restaurants()
    {
        return $this->belongsToMany('App\Models\Restaurant');
    }

}