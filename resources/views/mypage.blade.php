<?php
    // use \App\Models\User;
    use \Illuminate\Support\Facades\DB;

    // 1 = 상품 문의 게시판
    // 2 = Q & A 게시판
    // 3 = 후기 게시판
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('마이페이지') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a href="">
                <div class="p-6 bg-white border-b border-gray-200">
                    회원 정보 수정
                </div>
                </a>
                <div class="p-6 bg-white border-b border-gray-200">
                <div class="block" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                        <div @click="open = ! open">
                                상품 문의 내역 확인 
                            </div>
                        <div>
                            <div x-show="open" style="display: none;" @click="display: block;">
                                <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                                    <?php
                                        $posts = DB::table('posts')->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
                                        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                                        ->where('posts.user_id', '=', Auth::user()->id)
                                        ->where('posts.board_id', '=', 1)
                                        ->orderBy('posts.created_at','desc')
                                        ->get()
                                    ?>
                                    <!-- 총 게시글 수 {{ $posts->count() }} -->
                                    @if($posts->count() > 0)
                                    <table>
                                        <th>제목</th>
                                        <th>작성자</th>
                                        <th>조회수</th>
                                        <th>작성일</th>
                                        <th>답변여부</th>
        
                                    @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->name }}</td>
                                        <td>{{ $post->hit }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>{{ $post->state? '답변 완료' : '답변 대기' }}</td>
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
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    주문 내역 확인
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="block" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                        <div @click="open = ! open">
                                Q & A 내역 확인 
                            </div>
                        <div>
                            <div div x-show="open" style="display: none;" @click="display: block;">
                                <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                                    <?php
                                        $posts = DB::table('posts')->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
                                        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                                        ->where('posts.user_id', '=', Auth::user()->id)
                                        ->where('posts.board_id', '=', 2)
                                        ->orderBy('posts.created_at','desc')
                                        ->get()
                                    ?>
                                    <!-- 총 게시글 수 {{ $posts->count() }} -->
                                    @if($posts->count() > 0)
                                    <table>
                                        <th>제목</th>
                                        <th>작성자</th>
                                        <th>조회수</th>
                                        <th>작성일</th>
                                        <th>답변여부</th>
        
                                    @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->name }}</td>
                                        <td>{{ $post->hit }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>{{ $post->state? '답변 완료' : '답변 대기' }}</td>
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
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="block" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                        <div @click="open = ! open">
                                후기 게시글 내역 확인 
                            </div>
                        <div>
                            <div x-show="open" style="display: none;" @click="display: block;">
                                <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                                    <?php
                                        $posts = DB::table('posts')->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
                                        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                                        ->where('posts.user_id', '=', Auth::user()->id)
                                        ->where('posts.board_id', '=', 3)
                                        ->orderBy('posts.created_at','desc')
                                        ->get()
                                    ?>
                                    <!-- 총 게시글 수 {{ $posts->count() }} -->
                                    @if($posts->count() > 0)
                                    <table>
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


