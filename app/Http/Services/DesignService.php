<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Models\Design;
use App\Http\Models\Product;

class DesignService
{
    /**
     * @param Request $request
     * @param $user_id
     */
    public function designStore(Request $request, $user_id)
    {
        $base64Image = str_replace('data:image/png;base64,', '', $request->base64Image);
        $image = base64_decode($base64Image);

        // HTMLパース
        /*
            TODO Validation Check
        */

        $file_name = "product_" . $user_id . "_" . md5($user_id . time());
        file_put_contents(public_path() . "/image/product/" . $file_name . ".png", $image);

        // シールデザインペーパーの保存
        $product = new Product();
        $product->user_id = $user_id;
        $product->file_name = $file_name;
        $product->private_flag = true;
        $product->save();
    }

    /**
     * シールデザインのプライベートフラグの更新
     *
     * @param $product Product シールデザイン
     * @param $private_flag bool プライベートフラグ
     * @return bool
     */
    public function updatePrivateState($product, $private_flag)
    {
        $product->private_flag = $private_flag;
        $product->save();
        return true;
    }
}