<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class Book extends Model
{
    use HasFactory, Commentable;

    protected $fillable = ['title', 'slug', 'category_id', 'description', 'stock', 'qty', 'price', 'old_price', 'image'];

    public function getRouteKeyName()
    {
    	return 'slug';
    }

    public function category()
    {
    	return $this->belongsTo('App\Models\Category');
    }
}
