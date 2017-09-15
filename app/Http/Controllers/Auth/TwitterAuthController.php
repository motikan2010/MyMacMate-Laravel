<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TwitterAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('twitter')->user();
        echo $user->id;
        echo $user->nickname;
        echo $user->name;
        echo $user->avatar;
        exit;
    }
}