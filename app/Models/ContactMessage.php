<?php

namespace App\Models;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model 
{
    use Searchable;

    public $columns = ['name', 'email', 'phone', 'message', 'type'];
    protected $table = 'contact_messages';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'message', 'type');

}