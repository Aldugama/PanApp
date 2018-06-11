<?php

namespace App;

use App\User;
use App\Events\OrderCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = ['reference', 'date_exp', 'user_id', 'status'];
    
    public function products()
    {
        return $this->belongsToMany('App\Product')
                        ->withPivot('quantity', 'details')
                        ->using('App\OrderProduct')
                        ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
