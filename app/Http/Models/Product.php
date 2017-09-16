<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function designs(){
        return $this->hasMany('App\Http\Models\Design');
    }
}
