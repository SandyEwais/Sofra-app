<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('total_order_price', 'meals_cost', 'restaurant_net', 'state', 'notes', 'delivery_address', 'payment_method', 'delivery_fees', 'client_id', 'app_commission', 'restaurant_id');

    public function meals()
    {
        return $this->belongsToMany('App\Models\Meal');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}