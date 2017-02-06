<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    public function sticker(){
        return $this->belongsTo('App\Sticker');
    }
}
