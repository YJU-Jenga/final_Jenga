<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QnaController extends Controller
{
    //
    public function qnaList(){
        return view('qna');
    }
}
