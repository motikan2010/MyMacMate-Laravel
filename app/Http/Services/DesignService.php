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
     * デザインの公開状態の変更
     *
     * @param int $productId デザインID
     * @param int $userId ユーザID
     * @return array 結果配列
     */
    public function updatePublicStatus(int $productId, int $userId)
    {
        $product = Product::find($productId);
        if ( $product->user_id !== $userId ) {
            // 指定された会員IDとデザインの会員IDが一致しない
            return [
                'success' => false,
                'public_flag' => $product->private_flag,
            ];
        }

        $product->private_flag = !($product->private_flag);
        $product->save();

        return [
            'success' => true,
            'public_flag' => $product->private_flag === false,
        ];
    }
}