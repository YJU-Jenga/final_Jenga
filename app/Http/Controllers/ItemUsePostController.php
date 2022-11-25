<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ItemUsePostController extends Controller
{
    //
    public function create()
    {
        return view('board.write_item_use');
    }

    public function store(Request $request)
    {
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

        return redirect('/item_use');
    }

    public function viewItemUse(Request $request, $id)
    {
        $posts = DB::table('posts')
            ->where('posts.id', $id)
            ->increment('posts.hit', 1); // 컬럼값 1 증가 (조회수 증가)

        $posts = DB::table('posts')
            ->select(['posts.id', 'posts.title', 'posts.content', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.id', $id)
            ->get();

        return view('board.view_item_use', compact('posts'));
    }

    public function updateItemUse(Request $request, $id)
    {
        $posts = DB::table('posts')
            ->select(['posts.id', 'posts.title', 'posts.content', 'posts.password'])
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.id', $id)
            ->get();

        return view('board.update_item_use', compact('posts'));
    }

    public function updateok(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', 'size:4'],
        ]);
        $posts = DB::table('posts')
            ->where('posts.id', $id)
            ->update([
                'title' => $request->title,
                'content' => $request->content,
                'secret' => $request->secret ? 1 : 0,
                'password' => $request->password,
            ]);
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
