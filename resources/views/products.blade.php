<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('상품') }}
        </h2>
    </x-slot>
    <div class="container px-12 py-8 mx-auto">
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($products as $product)
                <a href="/product-detail/{{ $product->type }}"
                    class="w-full max-w-sm mx-auto overflow-hidden bg-white rounded-md shadow-md">
                    <img src="/storage/app/public/images/{{ $product->img }}" alt="" class="w-full max-h-60">
                    <div class="flex items-end justify-end w-full bg-cover">
                    </div>
                    <div class="px-5 py-3">
                        <h3 class="text-gray-700 uppercase">{{ $product->name }}</h3>
                        <span class="mt-2 text-gray-500">{{ $product->price }}₩</span>
                        <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="id">
                            <input type="hidden" value="{{ $product->name }}" name="name">
                            <input type="hidden" value="{{ $product->price }}" name="price">
                            <input type="hidden" value="{{ $product->img }}" name="image">
                            <input type="hidden" value="1" name="quantity">
                            <button
                                class="text-gray-900 bg-white border border-gray-300 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">장바구니
                                담기</button>
                        </form>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
