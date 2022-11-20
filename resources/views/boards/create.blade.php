@extends('layouts.board_layout')

@section('title')
    글 작성
@endsection

@section('content')
    {{-- //index에서 보낸 mode의 파라미터에 따라 타이틀이 바뀐다. --}}
    @if (app('request')->input('mode') == 0)
        <h1>댓글작성</h1>
    @else
        <h1>글 작성</h1>
    @endif

    <form action="/boards" method="POST">
        @csrf
        <p><label for="creator_name">NAME :</label>
            <input type="text" id="creator_name" name="creator_name" placeholder="이름 입력">
        </p><br>
        <p>
            <textarea name="memo" id="memo" placeholder="글 작성" cols="20" rows="10"></textarea>
        </p>

        <input type="hidden" id="mode" name="mode" value="{{ app('request')->input('mode') }}">
        <input type="hidden" id="id" name="id" value="{{ app('request')->input('id') }}">
        <input type="hidden" id="grp" name="grp" value="{{ app('request')->input('grp') }}">
        <input type="hidden" id="sort" name="sort" value="{{ app('request')->input('sort') }}">
        <input type="hidden" id="depth" name="depth" value="{{ app('request')->input('depth') }}">
        <input type="hidden" id="page" name="page" value=" {{ app('request')->input('page') }}">
        <input type="submit">
    </form>
@endsection
