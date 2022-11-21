<?php
    use \Illuminate\Support\Facades\DB;
?>

<?php
  $posts = DB::table('posts')->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at'])
  ->leftJoin('users', 'posts.user_id', '=', 'users.id')
  ->where('posts.user_id', '=', Auth::user()->id)
  ->where('posts.board_id', '=', 3)
  ->orderBy('posts.created_at','desc')
  ->get();
?>

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('총 게시글 수 ') }} {{$posts->count()}}
    </h2>
  </x-slot>

  <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                @if($posts->count() > 0)
                <table class="table-auto">
                  <th>제목</th>
                  <th>작성자</th>
                  <th>조회수</th>
                  <th>작성일</th>
                @foreach ($posts as $post)
                  <tr>  
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->name }}</td>
                    <td>{{ $post->hit }}</td>
                    <td>{{ $post->created_at }}</td>
                  </tr>
                @endforeach
                </table>
                @else
                <p>게시글이 존재 하지 않습니다.</p>
                @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>