<?php

namespace App\Http\Controllers;

use App\Http\Services\DesignService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Models\Product;

class DesignController extends Controller
{

    private $designService;

    public function __construct(DesignService $designService){
        $this->middleware('auth');
        $this->designService = $designService;
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
        $user_id = Auth::user()->id;
        $this->designService->designStore($request, $user_id);
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
            'product' => $product,
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

    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if(Auth::user()->id != $product->user_id){
            // ログイン中ユーザのシールデザインではない場合
            return redirect('design');
        }

        // プライベートフラグの更新
        $private_flag = $request->input('private_flag');
        if (isset($private_flag)) {
            $this->designService->updatePrivateState($product, true);
        } else {
            $this->designService->updatePrivateState($product, false);
        }

        return redirect('design/' . $id);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        //
    }

}
