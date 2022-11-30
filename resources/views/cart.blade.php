<x-app-layout>
    {{--    <x-slot name="header">--}}
    {{--        <h2 class="text-xl font-semibold text-gray-800">--}}
    {{--            {{ __('장바구니') }}--}}
    {{--        </h2>--}}
    {{--    </x-slot>--}}
        <main class="my-8">
            <div class="container px-6 mx-auto">
                <div class="flex justify-center my-6">
                    <div class="flex flex-col w-full h-full p-8 text-gray-800 bg-white shadow-lg  pin-r pin-y md:w-4/5 lg:w-4/5">
                        @if ($message = Session::get('success'))
                            <div class="p-4 mb-6 bg-green-400 rounded">
                                <p class="text-green-800">{{ $message }}</p>
                            </div>
                        @endif
                        <h3 class="mt-3 mb-5 text-3xl font-bold">장바구니</h3>
                        <div>
    
    
                            <table class="w-full h-full mb-3 text-sm lg:text-base" ellspacing="0">
                                <thead>
                                    <tr class="h-12 font-semibold uppercase bg-gray-300">
                                        <th class=""></th>
                                        <th class="">이름</th>
                                        <th class="">수량</th>
                                        <th class="pr-3">가격</th>
                                        <th class="">삭제</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($cartItems as $item)
                                        <tr class="h-full border-b">
    {{--                                        img--}}
                                            <td class="py-2">
                                                <a href='product-detail/{{ $item->id }}'>
                                                    <img src="/storage/images/{{ $item->attributes->image }}"
                                                        class="hidden object-contain w-20 rounded md:table-cell" alt="Thumbnail">
                                                </a>
                                            </td>
    {{--                                        product_name--}}
                                            <td>
                                                <a href='product-detail/{{ $item->id }}'>
                                                    <p class="font-bold text-center">{{ $item->name }}
                                                    </p>
    
                                                </a>
                                            </td>
    {{--                                            product_update--}}
                                            <td class="">
                                                        <form action="{{ route('cart.update') }}" method="POST">
                                                            @csrf
                                                            <div class="flex items-center justify-center ">
                                                                <input class="" type="hidden" name="id"
                                                                       value="{{ $item->id }}">
    {{--                                                            <div class="text-center">--}}
                                                                    <input type="text" name="quantity"
                                                                           value="{{ $item->quantity }}"
                                                                           class="w-1/6 h-6 text-center text-gray-800 border border-gray-200 rounded-lg outline-none" />
                                                                    <button
                                                                        class="px-2 py-1 ml-1 text-sm text-center text-green-700 bg-white rounded-full shadow focus:outline-none focus:ring-gray-200">✓</button>
    
    {{--                                                            </div>--}}
                                                                </div>
    
                                                        </form>
                                            </td>
                                            <td class="text-center md:table-cell">
                                                <span class="pr-3 text-sm font-medium lg:text-base">
                                                    {{ $item->price }}₩
                                                </span>
                                            </td>
                                            <td class="text-center md:table-cell">
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                                    <button
                                                        class="px-3 py-1.5 text-white bg-red-500 hover:bg-red-600 rounded-full shadow">X</button>
                                                </form>
    
                                            </td>
                                        </tr>
                                    @endforeach
    
                                </tbody>
                            </table>
    
                            <div class="flex flex-col items-end text-4xl">
    
                                    <form action="{{ route('cart.clear') }}" method="POST">
                                        @csrf
                                        <button class="px-4 py-2 mb-8 text-sm text-gray-100 bg-gray-500 rounded shadow hover:bg-gray-600">장바구니
                                            비우기</button>
                                    </form>
                                <div class="">총: {{ Cart::getTotal() }}₩</div>
                            </div>
    
                            <div class="flex justify-center mt-32">
                                @if(count($cartItems) > 0)
                                    <div>
                                        <form action="{{ route('order') }}" method="GET">
                                            @csrf
                                            <button class="px-6 py-2 text-sm text-green-100 bg-green-600 rounded shadow hover:bg-green-700">주문</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </x-app-layout>
    