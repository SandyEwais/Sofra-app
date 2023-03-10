<?php

namespace App\Models;

use App\Http\Traits\Searchable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable 
{
    use HasApiTokens, Searchable;
    protected $hidden = [
        'password',
        'pin_code'
    ];

    public $columns = ['name','email','phone'];
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('email', 'password', 'phone', 'pin_code', 'neighborhood_id', 'name','activation');

    public function neighborhood()
    {
        return $this->belongsTo('App\Models\Neighborhood');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
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