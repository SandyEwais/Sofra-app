<?php

namespace App\Models;

use App\Http\Traits\Searchable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Restaurant extends Authenticatable 
{
    use HasApiTokens, Searchable;
    protected $hidden = [
        'password',
        'pin_code'
    ];
    public $columns = ['name'];
    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'password', 'image', 'star_rate', 'minimum_charge', 'delivery_fees', 'state', 'contact_phone', 'whatsapp', 'neighborhood_id');

    public function meals()
    {
        return $this->hasMany('App\Models\Meal');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function neighborhood()
    {
        return $this->belongsTo('App\Models\Neighborhood');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notificatable');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function ctokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenable');
    }

}