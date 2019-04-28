<?php

namespace App\Http\Controllers;


class TopController extends Controller
{

    public function index() {
        $stickers = [
            ['d', 'Sticker "D"'],
            ['e', 'Sticker "E"'],
            ['m', 'Sticker "M"'],
            ['o', 'Sticker "O"']
        ];

        return view('top.index')->with('stickers', $stickers);
    }
}