<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function productList()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }

    public function productDetail(Request $request, $id)
    {
        $products = DB::table('products')->where('id', $id)->get();
        return view('products_detail', compact('products'));
    }

    public function store(Request $request)
    {
        // dd(explode(".", $_FILES['img']['name']));

        //php artisan storage:link
        //sail artisan storage:link 명령어 입력 필수

        $name = explode(".", $_FILES['img']['name']);   // 파일이름 확장자 구분
        $img = $name[0] . strtotime("Now") . '.' . $name[1];    // 파일이름 시간 추가해서 수정
        $request->file('img')->storeAs('images', $img, 'public');

        DB::table('products')->insert([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'type' => $request->type,
            'img' => $img,
        ]);
        session()->flash('success', 'Product is Added Successfully !');

        return redirect()->route('products.list');
    }

    public function create()
    { // 생성, 뷰만 보여주면 됨, 값을 저장하는 것은 store에서 처리하기 때문
        return view('register_product');
    }
}