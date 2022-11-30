<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductInquiryController extends Controller
{
    public function create()
    {
        return view('board.write_product_inquiry');
    }

    public function index()
    {
        $posts = DB::table('posts')->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.board_id', '=', 1)
            ->orderBy('posts.created_at', 'desc')
            ->get();

        return view('board.product_inquiry', ['posts' => $posts]);
    }

    public function store(Request $request)
    {

        if ($request->img) {
            $name = explode(".", $_FILES['img']['name']);   // 파일이름 확장자 구분
            $img = $name[0] . strtotime("Now") . '.' . $name[1];    // 파일이름 시간 추가해서 수정
            $request->file('img')->storeAs('images', $img, 'public');

            if ($request->secret) {
                $request->validate([
                    'password' => ['required', 'size:4'],
                ]);
                $user = DB::table('posts')
                    ->insert([
                        'user_id' => Auth::user()->id,
                        'board_id' => 1,
                        'title' => $request->title,
                        'content' => $request->content,
                        'secret' => 1,
                        'password' => $request->password,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'img' => $img,
                    ]);
            } else {
                $user = DB::table('posts')
                    ->insert([
                        'user_id' => Auth::user()->id,
                        'board_id' => 1,
                        'title' => $request->title,
                        'content' => $request->content,
                        'secret' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'img' => $img,
                    ]);
            }
        } else {
            if ($request->secret) {
                $request->validate([
                    'password' => ['required', 'size:4'],
                ]);
                $user = DB::table('posts')
                    ->insert([
                        'user_id' => Auth::user()->id,
                        'board_id' => 1,
                        'title' => $request->title,
                        'content' => $request->content,
                        'secret' => 1,
                        'password' => $request->password,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
            } else {
                $user = DB::table('posts')
                    ->insert([
                        'user_id' => Auth::user()->id,
                        'board_id' => 1,
                        'title' => $request->title,
                        'content' => $request->content,
                        'secret' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
            }
        }

        return redirect('/product_inquiry');
    }

    public function viewProductInquiry(Request $request, $id)
    {
        $posts = DB::table('posts')
            ->where('posts.id', $id)
            ->increment('posts.hit', 1); // 컬럼값 1 증가 (조회수 증가)

        $posts = DB::table('posts')->select(['posts.id', 'posts.user_id', 'posts.title', 'posts.content', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state', 'posts.img', 'posts.board_id'])
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.id', $id)
            ->get();

        return view('board.view_product_inquiry', compact('posts'));
    }

    public function updateProductInquiry(Request $request, $id)
    {
        $posts = DB::table('posts')
            ->select(['posts.id', 'posts.board_id', 'posts.title', 'posts.content', 'posts.secret', 'posts.password'])
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.id', $id)
            ->get();

        return view('board.update_product_inquiry', compact('posts'));
    }

    public function updateok(Request $request, $id)
    {
        if ($request->secret) {
            $request->validate([
                'password' => ['required', 'size:4'],
            ]);
            $posts = DB::table('posts')
                ->where('posts.id', $id)
                ->update([
                    'title' => $request->title,
                    'content' => $request->content,
                    'secret' => 1,
                    'password' => $request->password,
                ]);
        } else {
            $posts = DB::table('posts')
                ->where('posts.id', $id)
                ->update([
                    'title' => $request->title,
                    'content' => $request->content,
                    'secret' => 0,
                    'password' => $request->password,
                ]);
        }

        return view('board.updateok_product_inquiry');
    }

    public function deleteck(Request $request, $id)
    {
        $posts = DB::table('posts')->where('id', $id)->get();
        return view('board.deleteck_product_inquiry', compact('posts'));
    }

    public function deleteProductInquiry(Request $request, $id)
    {
        $posts = DB::table('posts')->where('id', $id)->delete();
        return view('board.deleteok_product_inquiry');
    }
}
