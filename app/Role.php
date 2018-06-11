<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    const ADMIN = 1;
    const TIENDA = 2;
    const HORNO = 3;

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
