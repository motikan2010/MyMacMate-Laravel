<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Design;

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
        return view('design.create');
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
        $result = [];
        $result['class'] = $crawler->filter('div')->each(function ($node) {
            return trim($node->attr('class'));
        });
        $result['style'] = $crawler->filter('div')->each(function ($node) {
            return $node->attr('style');
        });
        // style属性内のcssを取得
        foreach ($result['style'] as $i => $css) {
            // top、left、height、widthの格納
            $target_css = ['top', 'left',  'height', 'width'];
            foreach ($target_css as $css_k) {
                if(preg_match('/' . $css_k . ': ([0-9|¥.]*?)px;/', $css, $css_v)){
                    $result['css'][$css_k] = $css_v[1];
                }
            }
            // 角度の格納
            if(preg_match('/transform: (.*?);/', $css, $transform)){
                $result['css']['transform'] = $transform[1];
            }

            $design = newDesign();

            $destroy->user_id = 1;
            $design->group = 1;
            $design->img_top = $result['css']['top'];
            $design->img_left = $result['css']['left'];
            $design->img_height = $result['css']['height'];
            $design->img_width = $result['css']['width'];
            $design->transform = $result['css']['transform'];

            $design->save();
        }

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
