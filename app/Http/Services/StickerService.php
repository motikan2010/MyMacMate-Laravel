<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use \File;
use App\Http\Models\Sticker;

class StickerService
{
    public function store(Request $request, int $userId) {
        $sticker = new Sticker();

        $sticker->user_id = $userId;
        $sticker->name = $request->name;

        // 画像の保存
        $file = $request->file('image_file');
        $images_path = public_path() . "/image/sticker";
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
    }
}