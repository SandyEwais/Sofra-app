<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealOrder extends Model 
{
    

    protected $table = 'meal_order';
    public $timestamps = true;
    protected $fillable = array('meal_id', 'order_id', 'notes', 'quantity', 'meal_price');

}