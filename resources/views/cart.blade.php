<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('장바구니') }}
        </h2>
    </x-slot>
    <main class="my-8">
        <div class="container px-6 mx-auto">
            <div class="flex justify-center my-6">
                <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                    @if ($message = Session::get('success'))
                        <div class="p-4 mb-3 bg-green-400 rounded">
                            <p class="text-green-800">{{ $message }}</p>
                        </div>
                    @endif
                    <h3 class="text-3xl font-bold">장바구니</h3>
                    <div class="flex-1">
                        <table class="w-full text-sm lg:text-base" cellspacing="0">
                            <thead>
                                <tr class="h-12 uppercase">
                                    <th class="hidden md:table-cell"></th>
                                    <th class="text-left pl-9">이름</th>
                                    <th class="pl-5 text-left lg:text-right lg:pl-0">
                                        <span class="lg:hidden" title="Quantity">수량</span>
                                        <span class="hidden lg:inline">수량</span>
                                    </th>
                                    <th class="hidden pr-6 text-right md:table-cell"> 가격</th>
                                    <th class="hidden pr-2 text-right md:table-cell"> 삭제 </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td class="hidden pb-4 md:table-cell">
                                            <a href="#">
                                                <img src="{{ $item->attributes->image }}" class="w-20 rounded"
                                                    alt="Thumbnail">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#">
                                                <p class="mb-2 font-bold md:ml-4">{{ $item->name }}
                                                </p>

                                            </a>
                                        </td>
                                        <td class="justify-center mt-6 md:justify-end md:flex">
                                            <div class="h-10 w-28">
                                                <div class="relative flex flex-row w-full h-8">

                                                    <form action="{{ route('cart.update') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $item->id }}">
                                                        <input type="text" name="quantity"
                                                            value="{{ $item->quantity }}"
                                                            class="w-16 h-6 text-center text-gray-800 border rounded outline-none" />
                                                        <button
                                                            class="px-4 mt-1 py-1.5 text-sm rounded shadow text-gray-900 bg-white border border-gray-300 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="hidden text-right md:table-cell">
                                            <span class="text-sm font-medium lg:text-base">
                                                {{ $item->price }}₩
                                            </span>
                                        </td>
                                        <td class="hidden text-right md:table-cell">
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}" name="id">
                                                <button
                                                    class="px-4 py-2 text-white bg-red-500 rounded-full shadow">X</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div>
                            총: {{ Cart::getTotal() }}₩
                        </div>
                        <div>
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button class="px-6 py-2 text-sm text-red-100 bg-red-500 rounded shadow">장바구니
                                    비우기</button>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>