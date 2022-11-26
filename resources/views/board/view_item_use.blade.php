<?php

use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;

$post = $posts[0];

$comments = DB::table('comments')->select(['comments.id', 'comments.content', 'comments.created_at', 'users.name'])
  ->leftJoin('users', 'comments.user_id', '=', 'users.id')
  ->leftJoin('posts', 'comments.post_id', '=', 'posts.id')
  ->where('comments.post_id', '=', $post->id)
  ->orderBy('posts.created_at', 'desc')
  ->get();
?>
<style>
  HTML CSSResult Skip Results Iframe EDIT ON body {
    padding: 1.5em;
    background: #f5f5f5
  }

  table {
    border: 1px #a39485 solid;
    font-size: .9em;
    box-shadow: 0 2px 5px rgba(0, 0, 0, .25);
    width: 100%;
    border-collapse: collapse;
    border-radius: 5px;
    overflow: hidden;
  }

  th {
    text-align: left;
  }

  thead {
    font-weight: bold;
    color: #fff;
    background: #73685d;
  }

  td,
  th {
    padding: 1em .5em;
    vertical-align: middle;
  }

  td {
    border-bottom: 1px solid rgba(0, 0, 0, .1);
    background: #fff;
  }

  a {
    color: #73685d;
  }

  @media all and (max-width: 768px) {

    table,
    thead,
    tbody,
    th,
    td,
    tr {
      display: block;
    }

    th {
      text-align: right;
    }

    table {
      position: relative;
      padding-bottom: 0;
      border: none;
      box-shadow: 0 0 10px rgba(0, 0, 0, .2);
    }

    thead {
      float: left;
      white-space: nowrap;
    }

    tbody {
      overflow-x: auto;
      overflow-y: hidden;
      position: relative;
      white-space: nowrap;
    }

    tr {
      display: inline-block;
      vertical-align: top;
    }

    th {
      border-bottom: 1px solid #a39485;
    }

    td {
      border-bottom: 1px solid #e5e5e5;
    }


  }
</style>

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('사용 후기') }}
    </h2>
  </x-slot>
  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <table class="table-auto" width=100% border-top=1px solid=#444444 border-collapse=collapse>
            <th>제목</th>
            <th>글쓴이</th>
            <th>내용</th>
            <th>조회수</th>
            <th>작성일</th>
            @if($post->img != null)
            <th>이미지</th>
            @endif
            <tr>
              <td>{{ $post -> title }}</td>
              <td>{{ $post -> name }}</td>
              <td>{{ $post -> content }}</td>
              <td>{{ $post -> hit }}</td>
              <td>{{ $post -> created_at }}</td>
              @if($post->img != null)
              <td> <img src="/storage/images/{{ $post->img }}" alt="" class="w-full max-h-60"></td>
              @endif
            </tr>
          </table>
          <div>
            @foreach ($comments as $comment)
            <div>
              <h1>작성자 : {{ $comment->name }}</h1>
              <h1>내용 : {{ $comment->content }}</h1>
              <h1>작성일 :{{ $comment->created_at }}</h1>
            </div>
            @endforeach
          </div>
          @if(Auth::user()->permission == 1 && $post->state == 0)
          @auth()
          <div class="w-4/5 mx-auto mt-6 text-right">
            <form method="post" action="/comment_write">
              @csrf
              <textarea name="content" id="content" class="border border-blue-300 resize-none w-full h-32" Placeholder="답글을 작성해 주세요." required></textarea>
              <x-primary-button class="ml-4 mt-4">
                <input type="hidden" id="id" name="id" value="{{ $post->id }}">
                <input type="submit" value="작성">
              </x-primary-button>
            </form>
          </div>
          @endauth
          @endif
        </div>
      </div>
      <div class="flex items-center justify-end mt-4">
        <a href="{{ route('item_use') }}">
          <x-primary-button class="ml-4">
            {{ __('목록') }}
          </x-primary-button>
        </a>
        <a href="/update_item_use/{{ $post->id }}">
          <x-primary-button class="ml-4">
            {{ __('수정') }}
          </x-primary-button>
        </a>
        <a href="/deleteck_item_use/{{ $post->id }}">
          <x-primary-button class="ml-4">
            {{ __('삭제') }}
          </x-primary-button>
        </a>
      </div>
    </div>
  </div>
</x-app-layout>