<?php

namespace App\Models;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class City extends Model 
{
    use Searchable;

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name');

    public function neighborhoods()
    {
        return $this->hasMany('App\Models\Neighborhood');
    }

}