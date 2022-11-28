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
    if($request->id == 1){
      return redirect('/item_use');
    } else if($request->id == 2){
      return redirect('/q&a');
    } else {
      return redirect('/product_inquiry');
    }
  }
}