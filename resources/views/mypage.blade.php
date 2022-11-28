<?php
// use \App\Models\User;
use Illuminate\Support\Facades\DB;

// 1 = 상품 문의 게시판
// 2 = Q & A 게시판
// 3 = 후기 게시판
$query_string = $_SERVER['REQUEST_URI'];
$page = 10;
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
                    @if (strpos($query_string, '=') == 28)
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
                                $pi_posts = DB::table('posts')
                                    ->select(['posts.title', 'posts.id', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
                                    ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                                    ->where('posts.user_id', '=', Auth::user()->id)
                                    ->where('posts.board_id', '=', 1)
                                    ->orderBy('posts.created_at', 'desc')
                                    ->get();
                                
                                $pi_posts_page = DB::table('posts')
                                    ->select(['posts.title', 'users.name', 'posts.id', 'posts.hit', 'posts.created_at', 'posts.state'])
                                    ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                                    ->where('posts.user_id', '=', Auth::user()->id)
                                    ->where('posts.board_id', '=', 1)
                                    ->orderBy('posts.created_at', 'desc')
                                    ->paginate($page, $columns = ['*'], $pageName = 'product_inquiry_page');
                                ?>
                                <!-- 총 게시글 수 {{ $pi_posts->count() }} -->
                                @if ($pi_posts->count() > 0)
                                    <table class="table-auto">
                                        <th>제목</th>
                                        <th>작성자</th>
                                        <th>조회수</th>
                                        <th>작성일</th>
                                        <th>답변여부</th>

                                        @foreach ($pi_posts_page as $pi_post)
                                            <tr onclick="location.href='view_q&a/{{ $pi_post->id }}'"
                                                style="cursor:hand">
                                                <td>{{ $pi_post->title }}</td>
                                                <td>{{ $pi_post->name }}</td>
                                                <td>{{ $pi_post->hit }}</td>
                                                <td>{{ Carbon\Carbon::parse($pi_post->created_at)->format('Y-m-d') }}
                                                </td>
                                                <td>{{ $pi_post->state ? '답변 완료' : '답변 대기' }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <div style="text-align: center;">
                                        @if ($pi_posts_page->currentPage() > 1)
                                            <a href="{{ $pi_posts_page->previousPageUrl() }}"><i
                                                    class="fa fa-chevron-left" aria-hidden="true">←</i></a>
                                        @endif
                                        @for ($i = 1; $i <= $pi_posts_page->lastPage(); $i++)
                                            @if ($i == $pi_posts_page->currentPage())
                                                <a class="text-xl font-semibold"
                                                    href="{{ $pi_posts_page->url($i) }}">{{ $i }}</a>
                                            @else
                                                <a href="{{ $pi_posts_page->url($i) }}">{{ $i }}</a>
                                            @endif
                                        @endfor
                                        @if ($pi_posts_page->currentPage() < $pi_posts_page->lastPage())
                                            <a href="{{ $pi_posts_page->nextPageUrl() }}"><i
                                                    class="fa fa-chevron-right" aria-hidden="true"></i>→</a>
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
                @if (strpos($query_string, '=') == 19)
                    <div class="block" x-data="{ open: true }" @click.outside="open = false"
                        @close.stop="open = false">
                    @else
                        <div class="block" x-data="{ open: false }" @click.outside="open = false"
                            @close.stop="open = false">
                @endif
                <div @click="open = ! open">
                    주문 내역 확인
                </div>
                <div>
                    <div x-show="open" style="display: none;" @click="display: block;">
                        <div class="py-1 bg-white rounded-md ring-1 ring-black ring-opacity-5">
                            <?php
                            //주문번호, 주문일, 상품이름, 가격, 총가격, 주문상태
                            $orders = DB::table('orders')
                                ->select(['orders.id', 'orders.user_id', 'orders.created_at', 'products.name', 'products.price', 'count', 'state'])
                                ->leftJoin('products', 'product_id', '=', 'products.id')
                                ->where('orders.user_id', '=', Auth::user()->id)
                                ->orderBy('orders.created_at', 'desc')
                                ->get();
                            
                            $orders_page = DB::table('orders')
                                ->select(['orders.id', 'orders.user_id', 'orders.created_at', 'products.name', 'products.price', 'count', 'state'])
                                ->leftJoin('products', 'product_id', '=', 'products.id')
                                ->where('orders.user_id', '=', Auth::user()->id)
                                ->orderBy('orders.created_at', 'desc')
                                ->paginate($page, $columns = ['*'], $pageName = 'orders_page');
                            
                            ?>
                            <!-- 총 게시글 수 {{ $orders->count() }} -->
                            @if ($orders->count() > 0)
                                <table class="table-auto">
                                    <th>주문번호</th>
                                    <th>주문일</th>
                                    <th>상품이름</th>
                                    <th>가격</th>
                                    <th>총가격</th>
                                    <th>주문상태</th>

                                    @foreach ($orders_page as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->price }}원</td>
                                            <td>{{ $order->price * $order->count }}원</td>
                                            <td>{{ $order->state ? '주문 처리 완료' : '주문 접수 중' }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div style="text-align: center;">
                                    @if ($orders_page->currentPage() > 1)
                                        <a href="{{ $orders_page->previousPageUrl() }}"><i class="fa fa-chevron-left"
                                                aria-hidden="true">←</i></a>
                                    @endif
                                    @for ($i = 1; $i <= $orders_page->lastPage(); $i++)
                                        @if ($i == $orders_page->currentPage())
                                            <a class="text-xl font-semibold"
                                                href="{{ $orders_page->url($i) }}">{{ $i }}</a>
                                        @else
                                            <a href="{{ $orders_page->url($i) }}">{{ $i }}</a>
                                        @endif
                                    @endfor
                                    @if ($orders_page->currentPage() < $orders_page->lastPage())
                                        <a href="{{ $orders_page->nextPageUrl() }}"><i class="fa fa-chevron-right"
                                                aria-hidden="true"></i>→</a>
                                    @endif
                                </div>
                            @else
                                <p>주문 내역이 존재 하지 않습니다.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-6 bg-white border-b border-gray-200">
        @if (strpos($query_string, '=') == 18)
            <div class="block" x-data="{ open: true }" @click.outside="open = false" @close.stop="open = false">
            @else
                <div class="block" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
        @endif
        <div @click="open = ! open">
            Q & A 내역 확인
        </div>
        <div>
            <div div x-show="open" style="display: none;" @click="display: block;">
                <div class="py-1 bg-white rounded-md ring-1 ring-black ring-opacity-5">
                    <?php
                    $qna_posts = DB::table('posts')
                        ->select(['posts.title', 'posts.id', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
                        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                        ->where('posts.user_id', '=', Auth::user()->id)
                        ->where('posts.board_id', '=', 2)
                        ->orderBy('posts.created_at', 'desc')
                        ->get();
                    
                    $qna_posts_page = DB::table('posts')
                        ->select(['posts.title', 'users.name', 'posts.id', 'posts.hit', 'posts.created_at', 'posts.state'])
                        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                        ->where('posts.user_id', '=', Auth::user()->id)
                        ->where('posts.board_id', '=', 2)
                        ->orderBy('posts.created_at', 'desc')
                        ->paginate($page, $columns = ['*'], $pageName = 'q&a_page');
                    ?>
                    <!-- 총 게시글 수 {{ $qna_posts->count() }} -->
                    @if ($qna_posts->count() > 0)
                        <table class="table-auto">
                            <th>제목</th>
                            <th>작성자</th>
                            <th>조회수</th>
                            <th>작성일</th>
                            <th>답변여부</th>

                            @foreach ($qna_posts_page as $qna_post)
                                <tr onclick="location.href='view_q&a/{{ $qna_post->id }}'" style="cursor:hand">
                                    <td>{{ $qna_post->title }}</td>
                                    <td>{{ $qna_post->name }}</td>
                                    <td>{{ $qna_post->hit }}</td>
                                    <td>{{ Carbon\Carbon::parse($qna_post->created_at)->format('Y-m-d') }}</td>
                                    <td>{{ $qna_post->state ? '답변 완료' : '답변 대기' }}</td>
                                </tr>
                            @endforeach
                        </table>
                        <div style="text-align: center;">
                            @if ($qna_posts_page->currentPage() > 1)
                                <a href="{{ $qna_posts_page->previousPageUrl() }}"><i class="fa fa-chevron-left"
                                        aria-hidden="true">←</i></a>
                            @endif
                            @for ($i = 1; $i <= $qna_posts_page->lastPage(); $i++)
                                @if ($i == $qna_posts_page->currentPage())
                                    <a class="text-xl font-semibold"
                                        href="{{ $qna_posts_page->url($i) }}">{{ $i }}</a>
                                @else
                                    <a href="{{ $qna_posts_page->url($i) }}">{{ $i }}</a>
                                @endif
                            @endfor
                            @if ($qna_posts_page->currentPage() < $qna_posts_page->lastPage())
                                <a href="{{ $qna_posts_page->nextPageUrl() }}"><i class="fa fa-chevron-right"
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
        @if (strpos($query_string, '=') == 21)
            <div class="block" x-data="{ open: true }" @click.outside="open = false" @close.stop="open = false">
            @else
                <div class="block" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
        @endif
        <div @click="open = ! open">
            후기 게시글 내역 확인
        </div>
        <div>
            <div x-show="open" style="display: none;" @click="display: block;">
                <div class="py-1 bg-white rounded-md ring-1 ring-black ring-opacity-5">
                    <?php
                    $iu_posts = DB::table('posts')
                        ->select(['posts.title', 'posts.id', 'users.name', 'posts.hit', 'posts.created_at', 'posts.state'])
                        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                        ->where('posts.user_id', '=', Auth::user()->id)
                        ->where('posts.board_id', '=', 3)
                        ->orderBy('posts.created_at', 'desc')
                        ->get();
                    
                    $iu_posts_page = DB::table('posts')
                        ->select(['posts.title', 'users.name', 'posts.id', 'posts.hit', 'posts.created_at', 'posts.state'])
                        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
                        ->where('posts.user_id', '=', Auth::user()->id)
                        ->where('posts.board_id', '=', 3)
                        ->orderBy('posts.created_at', 'desc')
                        ->paginate($page, $columns = ['*'], $pageName = 'item_use_page');
                    ?>
                    <!-- 총 게시글 수 {{ $iu_posts->count() }} -->
                    @if ($iu_posts->count() > 0)
                        <table class="table-auto">
                            <th>제목</th>
                            <th>작성자</th>
                            <th>조회수</th>
                            <th>작성일</th>

                            @foreach ($iu_posts_page as $iu_post)
                                <tr onclick="location.href='view_item_use/{{ $iu_post->id }}'" style="cursor:hand">
                                    <td>{{ $iu_post->title }}</td>
                                    <td>{{ $iu_post->name }}</td>
                                    <td>{{ $iu_post->hit }}</td>
                                    <td>{{ Carbon\Carbon::parse($iu_post->created_at)->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </table>
                        <div style="text-align: center;">
                            @if ($iu_posts_page->currentPage() > 1)
                                <a href="{{ $iu_posts_page->previousPageUrl() }}"><i class="fa fa-chevron-left"
                                        aria-hidden="true">←</i></a>
                            @endif
                            @for ($i = 1; $i <= $iu_posts_page->lastPage(); $i++)
                                @if ($i == $iu_posts_page->currentPage())
                                    <a class="text-xl font-semibold"
                                        href="{{ $iu_posts_page->url($i) }}">{{ $i }}</a>
                                @else
                                    <a href="{{ $iu_posts_page->url($i) }}">{{ $i }}</a>
                                @endif
                            @endfor
                            @if ($iu_posts_page->currentPage() < $iu_posts_page->lastPage())
                                <a href="{{ $iu_posts_page->nextPageUrl() }}"><i class="fa fa-chevron-right"
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
