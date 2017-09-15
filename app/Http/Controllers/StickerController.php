<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sticker;
use \File;

class StickerController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * 画像一覧画面
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stickers = Auth::user()->stickers;
        
        return view('sticker.index')->with('stickers', $stickers);
    }

    /**
     * 画像アップロード画面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sticker.create');
    }

    /**
     * 画像データの新規作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'image_file' => 'required|image'
        ));

        $sticker = new Sticker();

        $sticker->user_id = Auth::user()->id;
        $sticker->name = $request->name;

        // 画像の保存
        $file = $request->file('image_file');
        $images_path = public_path() . "/stickers";
        $filename = $file->getClientOriginalName();
        $newfilename = "sticker_" . time() . "_" . md5($filename);
        $extension = File::extension($filename);
        $file->move($images_path, $newfilename . "." . $extension);

        // ファイル名・拡張子の保存
        $sticker->file_name = $newfilename;
        $sticker->extension = $extension;

        // 高さ・幅の保存
        list($width, $height) = getimagesize($images_path . '/' . $newfilename . "." . $extension);
        $sticker->height = $height;
        $sticker->width = $width;

        $sticker->save();

        return redirect()->route('sticker.index');
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
     * 画像データの削除
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sticker = Sticker::find($id);
        if($sticker->user_id == Auth::user()->id){
            // 画像ファイルの削除
            File::delete(public_path() . "/stickers/" .
                $sticker->file_name . "." . $sticker->extension);
            // 画像データの削除
            $sticker->delete();
        }
        return redirect()->route('sticker.index');
    }
}
