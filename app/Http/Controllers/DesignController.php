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
        $this->middleware('auth')->except(['showAll']);
        $this->designService = $designService;
    }

    /**
     * @return $this
     */
    public function index()
    {
        $products = Product::where('private_flag', false)->orderBy('created_at', 'desc')->get();

        $data = [
            'products' => $products,
        ];

        return view('design.index')->with($data);
    }

    /**
     * @return View
     */
    public function showMyAll()
    {
        $products = Auth::user()->products;

        return view('design.my_list')->with('products', $products);
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
            // ログイン中ユーザのデザインではない場合
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
     */
    public function update(Request $request)
    {

    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 公開状態の変更
     *
     * @param Request $request POSTリクエスト
     * @return array レスポンスJSON
     */
    public function changePublicStatus(Request $request)
    {
        $productId = $request->input('product_id');
        $userId = Auth::user()->id;

        // 公開情報の更新
        $resultArray = $this->designService->updatePublicStatus($productId, $userId);

        return $resultArray;
    }
}
