<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function designs(){
        return $this->hasMany('App\Design');
    }
}
