<?php
namespace App\Http\Controllers;

use App\Http\Models\Product;

class PublicController extends Controller
{

    /**
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function showAll()
    {
        $products = Product::where('private_flag', false)->orderBy('created_at', 'desc')->get();

        $data = [
            'products' => $products,
        ];

        return view('design.show_other')->with($data);
    }

}