<?php

namespace App\Models;

use App\Http\Traits\IsBetweenDate;
use App\Http\Traits\IsValidDate;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('image', 'title', 'description', 'start_date', 'end_date', 'restaurant_id');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}