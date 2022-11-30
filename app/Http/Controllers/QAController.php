<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class QAController extends Controller
{
    //
    public function create()
    {
        return view('board.write_q&a');
    }

    public function index()
    {
        $posts = DB::table('posts')->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.board_id', '=', 2)
            ->orderBy('posts.created_at', 'desc')
            ->get();

        return view('board.q&a', ['posts' => $posts]);
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
                        'board_id' => 2,
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
                        'board_id' => 2,
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
                        'board_id' => 2,
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
                        'board_id' => 2,
                        'title' => $request->title,
                        'content' => $request->content,
                        'secret' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
            }
        }


        return redirect('/q&a');
    }

    public function viewQA(Request $request, $id)
    {
        $posts = DB::table('posts')
            ->where('posts.id', $id)
            ->increment('posts.hit', 1); // 컬럼값 1 증가 (조회수 증가)

        $posts = DB::table('posts')->select(['posts.id', 'posts.user_id', 'posts.user_id', 'posts.board_id', 'posts.title', 'posts.content', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state', 'posts.img'])
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.id', $id)
            ->get();

        return view('board.view_q&a', compact('posts'));
    }

    public function updateQA(Request $request, $id)
    {
        $posts = DB::table('posts')
            ->select(['posts.id', 'posts.title', 'posts.content', 'posts.secret', 'posts.password'])
            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
            ->where('posts.id', $id)
            ->get();

        return view('board.update_q&a', compact('posts'));
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

        return view('board.updateok_q&a');
    }

    public function deleteck(Request $request, $id)
    {
        $posts = DB::table('posts')->where('id', $id)->get();
        return view('board.deleteck_q&a', compact('posts'));
    }

    public function deleteQA(Request $request, $id)
    {
        $posts = DB::table('posts')->where('id', $id)->delete();
        return view('board.deleteok_q&a');
    }
}
