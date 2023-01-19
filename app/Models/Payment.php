<?php

namespace App\Models;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model 
{
    use Searchable;
    public $columns = ['paid_fees'];

    protected $table = 'payments';
    public $timestamps = true;
    protected $fillable = array('paid_fees', 'payment_date', 'notes', 'restaurant_id');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}