<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function productList(){
        $products = Product::all();
        return view('products', compact('products'));
    }
    public function productDetail(Request $request, $type){
        $products = DB::table('products')->where('type', $type)->get();
        return view('products_detail', compact('products'));
    }
    public function store(Request $request)
    {
        DB::table('products')->insert([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'type' => $request->type,
            'img' => $request->img,
        ]);
        session()->flash('success', 'Product is Added Successfully !');

        return redirect()->route('products.list');
    }
    public function create(){ // 생성, 뷰만 보여주면 됨, 값을 저장하는 것은 store에서 처리하기 때문
        return view('register_product');
    }
    public function storeImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $imageName = time().'.'.$request->image->extension();

        // Public Folder
        $request->image->move(public_path('images'), $imageName);

        // //Store in Storage Folder
        // $request->image->storeAs('images', $imageName);

        // // Store in S3
        // $request->image->storeAs('images', $imageName, 's3');

        //Store IMage in DB 


        return back()->with('success', 'Image uploaded Successfully!')
        ->with('image', $imageName);
    }
}