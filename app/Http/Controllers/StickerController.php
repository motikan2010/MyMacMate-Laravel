<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\StickerService;

class StickerController extends Controller
{

    private $stickerService;

    public function __construct(StickerService $stickerService){
        $this->stickerService = $stickerService;
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

        $this->stickerService->store($request, Auth::user()->id);

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
