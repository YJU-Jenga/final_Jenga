<?php
//주문번호, 주문일, 상품이름, 가격, 총가격, 주문상태
$orders = DB::table('orders')->select(['orders.id', 'orders.user_id', 'orders.postal_code', 'orders.address', 'orders.created_at', 'products.name', 'products.price', 'count',  'state'])
    ->leftJoin('products', 'product_id', '=', 'products.id')
    ->orderBy('orders.created_at', 'desc')
    ->get();
$page = 10;
$orders_page = DB::table('orders')->select(['orders.id', 'orders.user_id', 'orders.postal_code', 'orders.address', 'orders.created_at', 'products.name', 'products.price', 'count',  'state'])
    ->leftJoin('products', 'product_id', '=', 'products.id')
    ->orderBy('orders.created_at', 'desc')
    ->paginate($page, $columns = ['*'], $pageName = 'orders_page');
?>

<x-app-layout>
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(Auth::user()->permission == 1)
                    <div class="py-1 bg-white rounded-md ring-1 ring-black ring-opacity-5">
                        @if($orders->count() > 0)
                        <table class="table-auto">
                            <th>주문번호</th>
                            <th>주문일</th>
                            <th>상품이름</th>
                            <th>가격</th>
                            <th>개수</th>
                            <th>총가격</th>
                            <th>우편번호</th>
                            <th>주소</th>
                            <th>주문상태</th>
                            <th>주문관리</th>
                            @foreach ($orders_page as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->price }}원</td>
                                <td>{{ $order->count }}개</td>
                                <td>{{ ($order->price * $order->count)}}원</td>
                                <td>{{ $order->postal_code }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->state? '주문 처리 완료' : '주문 접수 중' }}</td>
                                <td>
                                    <form method="POST" action="/update_order/{{ $order->id }}">
                                        @csrf
                                        <x-primary-button class="ml-4">
                                            {{ __('접수') }}
                                        </x-primary-button>
                                    </form>

                                    <form method="POST" action="/delete_order/{{ $order->id }}">
                                        @csrf
                                        <x-primary-button class="ml-4">
                                            {{ __('삭제') }}
                                        </x-primary-button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div style="text-align: center;">
                            @if ($orders_page->currentPage() > 1)
                            <a href="{{ $orders_page->previousPageUrl() }}"><i class="fa fa-chevron-left" aria-hidden="true">←</i></a>
                            @endif
                            @for($i = 1; $i <=$orders_page->lastPage(); $i++)
                                @if($i == $orders_page->currentPage())
                                <a class="text-xl font-semibold" href="{{$orders_page->url($i)}}">{{$i}}</a>
                                @else
                                <a href="{{$orders_page->url($i)}}">{{$i}}</a>
                                @endif
                                @endfor
                                @if ($orders_page->currentPage() < $orders_page->lastPage() )
                                    <a href="{{$orders_page->nextPageUrl()}}"><i class="fa fa-chevron-right" aria-hidden="true"></i>→</a>
                                    @endif
                        </div>
                        @else
                        <p>주문 내역이 존재 하지 않습니다.</p>
                        @endif
                    </div>
                    @else
                    <a href="/">
                        <h1>주문 관리는 관리자만 할 수 있습니다.</h1>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>