<?php
    use \App\Models\User;
    use \Illuminate\Support\Facades\DB;
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
                <div class="p-6 bg-white border-b border-gray-200">
                    회원 정보 수정
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    문의 내역 확인
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    주문 내역 확인
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="block" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                        <div @click="open = ! open">
                                후기 게시글 내역 확인 
                            </div>
                        <div>
                            <div x-show="open"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="absolute z-50 mt-2 rounded-md shadow-lg "
                                    style="display: none;"
                                    @click="open = false">
                                <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                                    <?php
                                        $posts = DB::table('posts')->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
                                        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                                        ->where('posts.user_id', '=', Auth::user()->id)
                                        ->where('posts.board_id', '=', 2)
                                        ->orderBy('posts.created_at','desc')
                                        ->get()
                                    ?>
                                    총 게시글 수 {{ $posts->count() }}
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
