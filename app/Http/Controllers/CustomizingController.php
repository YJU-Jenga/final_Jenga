<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomizingController extends Controller
{
    public function create()
    {
        return view('customizing');
    }

    public function store(Request $request)
    {
        if ($request->img) {
            $name = explode(".", $_FILES['img']['name']);   // 파일이름 확장자 구분
            $img = $name[0] . strtotime("Now") . '.' . $name[1];    // 파일이름 시간 추가해서 수정
            $request->file('img')->storeAs('customizing_models', $img, 'public');

            return view('Three.datgui', ['img'=> $img]);
        }
    }
}