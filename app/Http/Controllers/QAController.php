<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class QAController extends Controller
{
    //
    public function create()
    {
        return view('board.write_q&a');
    }

    public function store(Request $request)
    {
        if($request->secret){
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
        }
        else {
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

        return redirect('/q&a');
    }
}