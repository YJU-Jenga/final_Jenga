<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        return view('cart', compact('cartItems'));
    }


    public function addToCart(Request $request)
    {
        $carts = DB::table('carts')->select(['*'])
            ->where('product_id', '=', $request->id)
            ->where('user_id', '=', Auth::user()->id)
            ->get();
        // dd(count($carts));
        if (count($carts) == 1) {
            // DB::table('carts')
            //     ->where('product_id','=', $request->id)
            //     ->where('user_id','=', Auth::user()->id)
            //     ->update(['count' => $request->quantity + 1, 'total_price' => $request->price * $request->quantity]);
            session()->flash('info', '이미 장바구니에 담긴 상품입니다. 수정은 장바구니에서 해주세요.');
            return redirect()->route('cart.list');
        } else {
            DB::table('carts')->insert([
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
                'count' => $request->quantity,
                'total_price' => $request->price,
            ]);
            \Cart::add([
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'attributes' => array(
                    'image' => $request->image,
                )
            ]);
            session()->flash('success', 'Product is Added to Cart Successfully !');
        }

        return redirect()->route('cart.list');
    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );
        DB::table('carts')
            ->where('product_id', $request->id)
            ->where('user_id', Auth::user()->id)
            ->update(['count' => $request->quantity, 'total_price' => 315000 * $request->quantity]);

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);

        DB::table('carts')
            ->where('product_id', $request->id)
            ->where('user_id', Auth::user()->id)
            ->delete();

        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        DB::table('carts')
            ->where('user_id', Auth::user()->id)
            ->delete();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
}