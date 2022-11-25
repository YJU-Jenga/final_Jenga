<?php

use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;
?>

<?php
$posts = DB::table('posts')->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at'])
  ->leftJoin('users', 'posts.user_id', '=', 'users.id')
  ->where('posts.board_id', '=', 3)
  ->orderBy('posts.created_at', 'desc')
  ->get();

$page = 10;
$posts_page = DB::table('posts')->select(['posts.id', 'posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
  ->leftJoin('users', 'posts.user_id', '=', 'users.id')
  ->where('posts.board_id', '=', 3)
  ->orderBy('posts.created_at', 'desc')
  ->paginate($page);
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
      {{ __('총 게시글 수 ') }} {{$posts->count()}} | {{$posts_page->currentPage()}} / {{$posts_page->lastPage()}}
    </h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          @if($posts->count() > 0)
          <table class="table-auto" width=100% border-top=1px solid=#444444 border-collapse=collapse;>
            <th>제목</th>
            <th>작성자</th>
            <th>조회수</th>
            <th>작성일</th>
            @foreach ($posts_page as $post)
            <tr>
              <td><a href="view_item_use/{{ $post->id }}" style="color: blue">{{ $post->title }}</a></td>
              <td>{{ $post->name }}</td>
              <td>{{ $post->hit }}</td>
              <td>{{ $post->created_at }}</td>
            </tr>
            @endforeach
          </table>
          <div style="text-align: center;">
            @if ($posts_page->currentPage() > 1)
            <a href="{{ $posts_page->previousPageUrl() }}"><i class="fa fa-chevron-left" aria-hidden="true">←</i></a>
            @endif
            @for($i = 1; $i <=$posts_page->lastPage(); $i++)
              @if($i == $posts_page->currentPage())
              <a class="font-semibold text-xl" href="{{$posts_page->url($i)}}">{{$i}}</a>
              @else
              <a href="{{$posts_page->url($i)}}">{{$i}}</a>
              @endif
              @endfor
              @if ($posts_page->currentPage() < $posts_page->lastPage() )
                <a href="{{$posts_page->nextPageUrl()}}"><i class="fa fa-chevron-right" aria-hidden="true">→</i></a>
                @endif
          </div>
          @else
          <p>게시글이 존재 하지 않습니다.</p>
          @endif
        </div>
      </div>

      <a href="{{ route('write_item_use') }}">
        <div class="flex items-center justify-end mt-4">
          <x-primary-button class="ml-4">
            {{ __('작성') }}
          </x-primary-button>
        </div>
      </a>
    </div>
  </div>
</x-app-layout>