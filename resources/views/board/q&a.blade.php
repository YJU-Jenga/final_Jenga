<?php

use \Illuminate\Support\Facades\DB;
?>

<?php
$page = 10;
$posts_page = DB::table('posts')->select(['posts.id', 'posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state', 'posts.secret', 'posts.password'])
  ->leftJoin('users', 'posts.user_id', '=', 'users.id')
  ->where('posts.board_id', '=', 2)
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
        /*box-shadow: 0 2px 5px rgba(0, 0, 0, .25);*/
        width: 100%;
        border-collapse: collapse;
        border-radius: 5px;
        overflow: hidden;
    }

    th {
        text-align: left;
        border-bottom: 1.5px solid #999;
        background-color: #aaa;
        color: #fff
    }

    thead {
        font-weight: bold;
        color: #fff;
        background: #73685d;
    }

    td,
    th {
        padding: .8em .5em;
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

  <div class="py-6">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

            <h2 class="mt-4 ml-2 text-xl font-semibold leading-tight text-gray-800">
                {{ __('총 게시글 수 ') }} &nbsp {{$posts->count()}} &nbsp|&nbsp  {{$posts_page->currentPage()}} / {{$posts_page->lastPage()}}
            </h2>

          @if($posts->count() > 0)
          <table class="my-8 table-auto">
            <th class="text-center">제목</th>
            <th class="text-center">작성자</th>
            <th class="text-center">작성일</th>
              <th class="text-center">조회수</th>
            <th class="text-center">답변여부</th>

            @foreach ($posts_page as $post)
            @if($post->secret)
            <tr onclick="location.href='secret_post/{{ $post->id }}'" style="cursor:hand">
              <td class="text-center">🔒︎{{ $post->title }}</td>
              <td class="text-center">{{ $post->name }}</td>
              <td class="text-center">{{ Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</td>
              <td class="text-center">{{ $post->hit }}</td>

              <td class="text-center">{{ $post->state? '답변 완료' : '답변 대기' }}</td>
            </tr>
            @else
            <tr onclick="location.href='view_q&a/{{ $post->id }}'" style="cursor:hand">
              <td class="text-center">{{ $post->title }}</td>
              <td class="text-center">{{ $post->name }}</td>
              <td class="text-center">{{ Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</td>
              <td class="text-center">{{ $post->hit }}</td>

              <td class="text-center">{{ $post->state? '답변 완료' : '답변 대기' }}</td>
            </tr>
            @endif
            @endforeach
          </table>
          <div class="flex justify-center">
            {{ $posts_page->onEachSide(2)->links() }}
          </div>
          @else
          <p>게시글이 존재 하지 않습니다.</p>
          @endif
        </div>
      </div>

        <div class="flex items-center justify-end mt-4 mr-4">
      <a href="{{ route('write_q&a') }}">
          <x-primary-button class="ml-4">
            {{ __('작성') }}
          </x-primary-button>
      </a>
        </div>
    </div>
  </div>
</x-app-layout>
