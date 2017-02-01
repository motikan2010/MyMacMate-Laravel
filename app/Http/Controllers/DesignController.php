<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Goutte\Client;

use App\Sticker;
use App\Design;
use App\Product;

class DesignController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('design.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $stickers = Auth::user()->stickers;

        return view('design.create')->with('stickers', $stickers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $delete_words = ["ui-widget-content","jquery-ui-draggable","ui-draggable"];
        $html = str_replace($delete_words, "", $request->html);

        $client = new Client();
        $crawler = $client->request('HEAD', null);
        $crawler->clear();
        $crawler->addHtmlContent($html);
        $results_arr = [];
        $results_arr = $crawler->filter('div')->each(function ($node) {
            return [
                'class' => trim($node->attr('class')),
                'style' => $node->attr('style')
            ];
        });
        
        /*
            TODO Validation Check
        */

        $product = new Product();
        $product->user_id = Auth::user()->id;
        $product->file_name = "Sample"; // TODO
        $product->save();
        $product_id = $product->id;

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

        return $results_arr;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
