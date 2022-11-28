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

    public function __construct(cart $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
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
        $input = $request->validate([
            'roadAddress' => 'required',
            'postal_code' => 'required',
            'dd' => 'required'
        ]);
        $postal_code = $request->postal_code;
        $address = $request->roadAddress . " " . $request->extraAddress . " " . $request->detailAddress;

        $data = $request->get('dd');

        $data_arr = request('dd');

        $responseArray = json_decode($data_arr, true);

        \Cart::remove($request->id);



        foreach ($responseArray as $el) {
            //dd($el['name']);
            $product_id = $el['product_id'];
            $count = $el['count'];

            \Cart::remove($product_id);

            DB::table('orders')->insert([
                'user_id' => Auth::user()->id,
                'product_id' => $product_id,
                'postal_code' => $postal_code,
                'address' => $address,
                'count' => $count,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        DB::table('carts')
            //            ->where('product_id', $product_id)
            ->where('user_id', Auth::user()->id)
            ->delete();


        return redirect()->route('order.completed');
    }

    public function manage()
    {
        return view('order_management');
    }

    public function update(Request $request, $id)
    {
        DB::table('orders')->where('id', $id)->update(['state' => 1]);
        return view('order_management');
    }

    public function delete(Request $request, $id)
    {
        DB::table('orders')->where('id', $id)->delete();
        return view('order_management');
    }

    public function create()
    {
        return view('order_success');
    }
}
