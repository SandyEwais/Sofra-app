<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'order_id', 'is_read');

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function notificatable()
    {
        return $this->morphTo();
    }

}