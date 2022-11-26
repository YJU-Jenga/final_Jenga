<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ItemUsePostController extends Controller
{
    //
    public function create()
    {
        return view('board.write_item_use');
    }

    public function index()
    {
        $posts = DB::table('posts')->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.board_id', '=', 3)
            ->orderBy('posts.created_at', 'desc')
            ->get();

        return view('board.item_use', ['posts' => $posts]);
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
                        'board_id' => 3,
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
                        'board_id' => 3,
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
                        'board_id' => 3,
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
                        'board_id' => 3,
                        'title' => $request->title,
                        'content' => $request->content,
                        'secret' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
            }
        }

        return redirect('/item_use');
    }

    public function viewItemUse(Request $request, $id)
    {
        $posts = DB::table('posts')
            ->where('posts.id', $id)
            ->increment('posts.hit', 1); // 컬럼값 1 증가 (조회수 증가)

        $posts = DB::table('posts')
            ->select(['posts.id', 'posts.title', 'posts.content', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state', 'posts.img'])
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.id', $id)
            ->get();

        return view('board.view_item_use', compact('posts'));
    }

    public function updateItemUse(Request $request, $id)
    {
        $posts = DB::table('posts')
            ->select(['posts.id', 'posts.title', 'posts.content', 'posts.secret', 'posts.password'])
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.id', $id)
            ->get();

        return view('board.update_item_use', compact('posts'));
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

        return view('board.updateok_item_use');
    }

    public function deleteckItemUse(Request $request, $id)
    {
        $posts = DB::table('posts')->where('id', $id)->get();
        return view('board.deleteck_item_use', compact('posts'));
    }

    public function deleteItemUse(Request $request, $id)
    {
        $posts = DB::table('posts')->where('id', $id)->delete();
        return view('board.deleteok_item_use');
    }
}
