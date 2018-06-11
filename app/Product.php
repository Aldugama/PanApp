<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = "products";

    protected $fillable = ['name', 'reference', 'category_id'];


    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order')
                    ->withPivot('quantity', 'details')
                    ->using('App\OrderProduct')
                    ->withTimestamps();
    }

}
