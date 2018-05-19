<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Models\Sticker;
use App\Http\Models\Design;
use Symfony\Component\DomCrawler\Crawler;
use App\Http\Models\Product;

class DesignService
{
    /**
     * @param Request $request
     * @param $user_id
     */
    public function designStore(Request $request, $user_id)
    {
        $delete_words = ["ui-widget-content","jquery-ui-draggable","ui-draggable"];
        $html = str_replace($delete_words, "", $request->html);
        $base64Image = str_replace('data:image/png;base64,', '', $request->base64Image);
        $image = base64_decode($base64Image);

        // HTMLパース
        $crawler = new Crawler(null);
        $crawler->clear();
        $crawler->addHtmlContent($html);
        $results_arr = $crawler->filter('div')->each(function ($node) {
            return [
                'class' => trim($node->attr('class')),
                'style' => $node->attr('style')
            ];
        });

        /*
            TODO Validation Check
        */

        $file_name = "product_" . $user_id . "_" . md5($user_id . time());
        file_put_contents(public_path() . "/products/" . $file_name . ".png", $image);

        // シールデザインペーパーの保存
        $product = new Product();
        $product->user_id = $user_id;
        $product->file_name = $file_name;
        $product->private_flag = true;
        $product->save();
        $product_id = $product->id;

        // シールデザインペーパー構成要素の保存
        foreach ($results_arr as $result) {
            // top、left、height、widthの格納
            $property_arr = ['top', 'left',  'height', 'width'];
            foreach ($property_arr as $property) {
                if(preg_match('/' . $property . ': ([0-9|¥.]*?)px;/', $result['style'], $css_value)){
                    $result['css'][$property] = $css_value[1];
                }
            }

            // 角度取得
            if(preg_match('/transform: (.*?);/', $result['style'], $transform)){
                $result['css']['transform'] = $transform[1];
            }else{
                $result['css']['transform'] = 0;
            }

            $design = new Design();
            $design->product_id = $product_id;
            $sticker = Sticker::where('file_name', $result['class'])->first();
            $design->sticker_id = $sticker->id;
            $design->img_top = $result['css']['top'];
            $design->img_left = $result['css']['left'];
            $design->img_height = $result['css']['height'];
            $design->img_width = $result['css']['width'];
            $design->transform = $result['css']['transform'];
            $design->save();
        }
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