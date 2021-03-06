<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_title', 'qty', 'price', 'total', 'paid', 'delivered'];

    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }
}
