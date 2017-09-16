<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{

    public function sticker(){
        return $this->belongsTo('App\Http\Models\Sticker');
    }

}
