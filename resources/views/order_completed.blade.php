<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <h1 class="mb-10 text-4xl font-semibold leading-tight text-gray-800">
                    {{ __('주문') }}
                </h1>
                <h1>주문완료!</h1>

                <form action="{{ route('/') }}" method="GET">
                    @csrf
                    <button class="px-6 py-2 text-amber-100 bg-amber-500 rounded shadow text-l">메인</button>
                </form>

                <form action="{{ route('products.list') }}" method="GET">
                    @csrf
                    <button class="px-6 py-2 text-amber-100 bg-amber-500 rounded shadow text-l">상품 더보셈</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
