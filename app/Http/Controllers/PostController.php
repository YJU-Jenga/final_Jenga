<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    // 1 = 상품 문의 게시판
    // 2 = Q & A 게시판
    // 3 = 후기 게시판

    public function secretView(Request $request, $id){
        $posts = DB::table('posts')
            ->select(['board_id', 'password'])
            ->where('posts.id', $id)
            ->get();

        return view('board.secret_post', ['posts'=> $posts[0], 'id' => $id] );
    }
}