<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // ユーザID
            $table->increments('id');
            // ユーザ名
            $table->string('name');
            // メールアドレス・ログイン時に利用
            $table->string('email')->unique()->nullable();
            // パスワード
            $table->string('password')->nullable();
            // oauth認証のサイト区分 0:oauthなし 1:Twitter
            $table->tinyInteger('sns_type');
            // oauth認証ユーザID
            $table->integer('sns_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
