<?php
// use \App\Models\User;
use Illuminate\Support\Facades\DB;

// 1 = 상품 문의 게시판
// 2 = Q & A 게시판
// 3 = 후기 게시판
$query_string = $_SERVER['QUERY_STRING'];
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('마이페이지') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <a href="{{ route('register_update') }}">
                    <div class="p-6 bg-white border-b border-gray-200">
                        회원 정보 수정
                    </div>
                </a>
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (strpos($query_string, '=') == 20)
                        <div class="block" x-data="{ open: true }" @click.outside="open = false"
                            @close.stop="open = false">
                        @else
                            <div class="block" x-data="{ open: false }" @click.outside="open = false"
                                @close.stop="open = false">
                    @endif
                    <div @click="open = ! open">
                        상품 문의 내역 확인
                    </div>
                    <div>
                        <div x-show="open" style="display: none;" @click="display: block;">
                            <div class="py-1 bg-white rounded-md ring-1 ring-black ring-opacity-5">
                                <?php
                                $posts = DB::table('posts')
                                    ->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
                                    ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                                    ->where('posts.user_id', '=', Auth::user()->id)
                                    ->where('posts.board_id', '=', 1)
                                    ->orderBy('posts.created_at', 'desc')
                                    ->get();
                                
                                $page = 10;
                                $posts_page = DB::table('posts')
                                    ->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
                                    ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                                    ->where('posts.user_id', '=', Auth::user()->id)
                                    ->where('posts.board_id', '=', 1)
                                    ->orderBy('posts.created_at', 'desc')
                                    ->paginate($page, $columns = ['*'], $pageName = 'product_inquiry_page');
                                ?>
                                <!-- 총 게시글 수 {{ $posts->count() }} -->
                                @if ($posts->count() > 0)
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
                                                <td>{{ $post->state ? '답변 완료' : '답변 대기' }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <div style="text-align: center;">
                                        @if ($posts_page->currentPage() > 1)
                                            <a href="{{ $posts_page->previousPageUrl() }}"><i class="fa fa-chevron-left"
                                                    aria-hidden="true">←</i></a>
                                        @endif
                                        @for ($i = 1; $i <= $posts_page->lastPage(); $i++)
                                            @if ($i == $posts_page->currentPage())
                                                <a class="text-xl font-semibold"
                                                    href="{{ $posts_page->url($i) }}">{{ $i }}</a>
                                            @else
                                                <a href="{{ $posts_page->url($i) }}">{{ $i }}</a>
                                            @endif
                                        @endfor
                                        @if ($posts_page->currentPage() < $posts_page->lastPage())
                                            <a href="{{ $posts_page->nextPageUrl() }}"><i class="fa fa-chevron-right"
                                                    aria-hidden="true"></i>→</a>
                                        @endif
                                    </div>
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
                @if (strpos($query_string, '=') == 10)
                    <div class="block" x-data="{ open: true }" @click.outside="open = false"
                        @close.stop="open = false">
                    @else
                        <div class="block" x-data="{ open: false }" @click.outside="open = false"
                            @close.stop="open = false">
                @endif
                <div @click="open = ! open">
                    Q & A 내역 확인
                </div>
                <div>
                    <div div x-show="open" style="display: none;" @click="display: block;">
                        <div class="py-1 bg-white rounded-md ring-1 ring-black ring-opacity-5">
                            <?php
                            $posts = DB::table('posts')
                                ->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
                                ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                                ->where('posts.user_id', '=', Auth::user()->id)
                                ->where('posts.board_id', '=', 2)
                                ->orderBy('posts.created_at', 'desc')
                                ->get();
                            
                            $page = 10;
                            $posts_page = DB::table('posts')
                                ->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
                                ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                                ->where('posts.user_id', '=', Auth::user()->id)
                                ->where('posts.board_id', '=', 2)
                                ->orderBy('posts.created_at', 'desc')
                                ->paginate($page, $columns = ['*'], $pageName = 'q&a_page');
                            ?>
                            <!-- 총 게시글 수 {{ $posts->count() }} -->
                            @if ($posts->count() > 0)
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
                                            <td>{{ $post->state ? '답변 완료' : '답변 대기' }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div style="text-align: center;">
                                    @if ($posts_page->currentPage() > 1)
                                        <a href="{{ $posts_page->previousPageUrl() }}"><i class="fa fa-chevron-left"
                                                aria-hidden="true">←</i></a>
                                    @endif
                                    @for ($i = 1; $i <= $posts_page->lastPage(); $i++)
                                        @if ($i == $posts_page->currentPage())
                                            <a class="text-xl font-semibold"
                                                href="{{ $posts_page->url($i) }}">{{ $i }}</a>
                                        @else
                                            <a href="{{ $posts_page->url($i) }}">{{ $i }}</a>
                                        @endif
                                    @endfor
                                    @if ($posts_page->currentPage() < $posts_page->lastPage())
                                        <a href="{{ $posts_page->nextPageUrl() }}"><i class="fa fa-chevron-right"
                                                aria-hidden="true">→</i></a>
                                    @endif
                                </div>
                            @else
                                <p>게시글이 존재 하지 않습니다.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-6 bg-white border-b border-gray-200">
            @if (strpos($query_string, '=') == 13)
                <div class="block" x-data="{ open: true }" @click.outside="open = false" @close.stop="open = false">
                @else
                    <div class="block" x-data="{ open: false }" @click.outside="open = false"
                        @close.stop="open = false">
            @endif
            <div @click="open = ! open">
                후기 게시글 내역 확인
            </div>
            <div>
                <div x-show="open" style="display: none;" @click="display: block;">
                    <div class="py-1 bg-white rounded-md ring-1 ring-black ring-opacity-5">
                        <?php
                        $posts = DB::table('posts')
                            ->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
                            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                            ->where('posts.user_id', '=', Auth::user()->id)
                            ->where('posts.board_id', '=', 3)
                            ->orderBy('posts.created_at', 'desc')
                            ->get();
                        
                        $page = 10;
                        $posts_page = DB::table('posts')
                            ->select(['posts.title', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
                            ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                            ->where('posts.user_id', '=', Auth::user()->id)
                            ->where('posts.board_id', '=', 3)
                            ->orderBy('posts.created_at', 'desc')
                            ->paginate($page, $columns = ['*'], $pageName = 'item_use_page');
                        ?>
                        <!-- 총 게시글 수 {{ $posts->count() }} -->
                        @if ($posts->count() > 0)
                            <table class="table-auto">
                                <th>제목</th>
                                <th>작성자</th>
                                <th>조회수</th>
                                <th>작성일</th>

                                @foreach ($posts_page as $post)
                                    <tr>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->name }}</td>
                                        <td>{{ $post->hit }}</td>
                                        <td>{{ $post->created_at }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <div style="text-align: center;">
                                @if ($posts_page->currentPage() > 1)
                                    <a href="{{ $posts_page->previousPageUrl() }}"><i class="fa fa-chevron-left"
                                            aria-hidden="true">←</i></a>
                                @endif
                                @for ($i = 1; $i <= $posts_page->lastPage(); $i++)
                                    @if ($i == $posts_page->currentPage())
                                        <a class="text-xl font-semibold"
                                            href="{{ $posts_page->url($i) }}">{{ $i }}</a>
                                    @else
                                        <a href="{{ $posts_page->url($i) }}">{{ $i }}</a>
                                    @endif
                                @endfor
                                @if ($posts_page->currentPage() < $posts_page->lastPage())
                                    <a href="{{ $posts_page->nextPageUrl() }}"><i class="fa fa-chevron-right"
                                            aria-hidden="true">→</i></a>
                                @endif
                            </div>
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
