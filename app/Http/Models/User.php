<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'sns_type', 'sns_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * ユーザが保持しているステッカーを全て取得
     *
     * @return mixed
     */
    public function stickers()
    {
        return $this->hasMany('App\Http\Models\Sticker')->orderBy('created_at', 'desc');;
    }

    /**
     * ユーザが保持しているプロダクトを全て取得
     *
     * @return mixed
     */
    public function products()
    {
        return $this->hasMany('App\Http\Models\Product')->orderBy('created_at', 'desc');
    }

}
