<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    private $cart;

    public function __construct(cart $cart) {
        $this->cart = $cart;
    }

    public function index() {
        $carts = DB::table('carts')->get();
        $products_info = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('products.name', 'products.img', 'products.price', 'carts.count', 'carts.total_price', 'carts.product_id', 'carts.user_id')
            ->where('carts.user_id', Auth::user()->id)
            ->get();
        $price = DB::table('carts')
            ->where('user_id', Auth::user()->id)
            ->sum('total_price');
        return view('order', compact('products_info', 'price'));
    }

    public function store(Request $request)
    {
        // Request 에 대한 유효성 검사입니다, 다양한 종류가 있기에 공식문서를 보시는 걸 추천드립니다.
        // 유효성에 걸린 에러는 errors 에 담깁니다.
        $requests = $request->validate([
            'address' => 'required',
            'postal_code' => 'required',
            'dd' => 'required'
        ]);

        $user = Auth::user()->id;
        $vars = request('dd');
        $parsed_vars = json_decode($vars, true);
        // dd($request);
        return view('order_completed');
    }

    public function create(){
        return view('order_success');
    }
}