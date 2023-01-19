<?php

namespace App\Models;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model 
{
    use Searchable;

    protected $table = 'comments';
    public $timestamps = true;
    protected $fillable = array('rate', 'body', 'restaurant_id', 'client_id');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}