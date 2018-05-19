<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Models\Sticker;
use App\Http\Models\Design;
use App\Http\Models\Product;
use Symfony\Component\DomCrawler\Crawler;

class DesignController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * @return $this
     */
    public function index()
    {
        $products = Auth::user()->products;

        return view('design.index')->with('products', $products);
    }

    /**
     * @return $this
     */
    public function create()
    {

        $stickers = Auth::user()->stickers;

        return view('design.create')->with('stickers', $stickers);
    }

    /**
     * シールデザインの保存
     *
     * @param Request $request
     * @return int
     */
    public function store(Request $request)
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

        $user_id = Auth::user()->id;
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

        return 1;

    }

    /**
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show($id)
    {
        $product = Product::find($id);
        if(Auth::user()->id != $product->user_id){
            // ログイン中ユーザのシールデザインではない場合
            return redirect('design');
        }
        $designs = $product->designs;

        $stickers = Auth::user()->stickers;

        $data = [
            'designs' => $designs,
            'stickers' => $stickers
        ];

        return view('design.show')->with($data);
    }

    /**
     * @param $id
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        //
    }

}
