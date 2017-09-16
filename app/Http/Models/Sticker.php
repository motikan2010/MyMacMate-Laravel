<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Http\Models\User');
    }
}
