<?php
    use \Illuminate\Support\Facades\DB;
?>

<?php
  $posts = DB::table('posts')->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
  ->leftJoin('users', 'posts.user_id', '=', 'users.id')
  ->where('posts.user_id', '=', Auth::user()->id)
  ->where('posts.board_id', '=', 1)
  ->orderBy('posts.created_at','desc')
  ->get();

  $page = 10;
  $posts_page = DB::table('posts')->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
  ->leftJoin('users', 'posts.user_id', '=', 'users.id')
  ->where('posts.user_id', '=', Auth::user()->id)
  ->where('posts.board_id', '=', 1)
  ->orderBy('posts.created_at','desc')
  ->paginate($page);
?>

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
                <table class="table-auto">
                  <th>제목</th>
                  <th>작성자</th>
                  <th>조회수</th>
                  <th>작성일</th>
                  <th>답변여부</th>
                @foreach ($posts_page as $post)
                  <tr>  
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->name }}</td>
                    <td>{{ $post->hit }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->state? '답변 완료' : '답변 대기' }}</td>
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
        </div>
    </div>
</x-app-layout>