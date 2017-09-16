<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\User;

class TwitterAuthController extends Controller
{
    /**
     * Twitter OAuth認証のユーザ登録
     */
    public function auth()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * コールバック先
     */
    public function callback()
    {
        try{
            $user = Socialite::driver('twitter')->user();
        }catch(\InvalidArgumentException $ex){
            // ログイン失敗
            return redirect('/login');
        }
        $userId = $user->id;
        $userName = $user->nickname;
        $loginUser = $this->getTwitterUser($userId);

        if($loginUser !== null) {
            // ユーザログイン
            Auth::login($loginUser);
            $this->loginUser($loginUser);
            return redirect('/design/create');
        }else{
            // ユーザを新規登録
            User::create([
                'name' => $userName,
                'sns_type' => '1',
                'sns_id' => $userId,
            ]);
            $loginUser = $this->getTwitterUser($userId);
            $this->loginUser($loginUser);
            return redirect('/design/create');
        }

    }

    private function getTwitterUser($userId){
        return User::where('sns_id', $userId)->where('sns_type', '1')->first();
    }

    private function loginUser($loginUser){
        Auth::login($loginUser);
    }

}