<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    use SoftDeletes;
    
    protected $table = 'order_product';

    protected $fillable = ['product_id', 'order_id', 'quantity', 'details'];


//! Relacion
    public function products() {
        return $this->belongsTo(Product::class);
    }

    
}
