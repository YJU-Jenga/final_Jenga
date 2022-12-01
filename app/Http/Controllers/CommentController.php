<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
  //
  public function create()
  {
    return view('board.write_comment');
  }

  public function store(Request $request)
  {
    $posts = DB::table('posts')
      ->where('id', '=', $request->id)
      ->update([
        'state' => 1
      ]);

    $comments = DB::table('comments')
      ->insert([
        'content' => $request->content,
        'user_id' => Auth::user()->id,
        'post_id' => $request->id,
        'created_at' => now(),
        'updated_at' => now(),
      ]);

    // 1 = 상품 문의 게시판
    // 2 = Q & A 게시판
    // 3 = 후기 게시판

    if ($request->board_id == 1) {
      return redirect('/product_inquiry');
    } else if ($request->board_id == 2) {
      return redirect('/q&a');
    } else {
      return redirect('/item_use');
    }
  }

  public function delete(Request $request, $id)
  {
    $posts = DB::table('posts')
      ->where('id', '=', $request->id)
      ->update([
        'state' => 0
      ]);

    $comments = DB::table('comments')
      ->where('id', '=', $id)
      ->delete();

    if ($request->board_id == 1) {
      return redirect('/product_inquiry');
    } else if ($request->board_id == 2) {
      return redirect('/q&a');
    } else {
      return redirect('/item_use');
    }
  }
  public function update(Request $request, $id){
    $comments = DB::table('comments')
            ->select(['comments.id', 'comments.post_id', 'comments.post_id', 'comments.content'])
            ->leftJoin('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.id', $id)
            ->get();

        return view('board.update_comment', compact('comments'));
  }
  public function updateok(Request $request, $id)
    {
      $posts = DB::table('posts')
      ->where('id', '=', $request->id)
      ->update([
        'state' => 0
      ]);
      $comments = DB::table('comments')
          ->where('comments.id', $id)
          ->update([
              'content' => $request->content,
      ]);
      if ($request->board_id == 1) {
        return redirect('/product_inquiry');
      } else if ($request->board_id == 2) {
        return redirect('/q&a');
      } else {
        return redirect('/item_use');
      }
    }
}