<?php

namespace App\Models;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model 
{
    use Searchable;

    protected $table = 'meals';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'price', 'time', 'restaurant_id', 'image', 'price_sale', 'category_id');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

}