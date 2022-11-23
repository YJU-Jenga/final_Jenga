<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-8 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <h1 class="mb-10 text-4xl font-semibold leading-tight text-gray-800">
                    {{ __('주문') }}
                </h1>

                @if ($products_info->count() > 0)
                    <table class="w-full h-full text-center table-auto">
                        <tr>
                            <td class="w-1/12"></td>
                            <td class="w-5/12 ">상품명</td>
                            <td class="w-1/12 ">상품개수</td>
                            <td class="w-1/12 ">가격</td>
                        </tr>

                        @foreach ($products_info as $product)
                            <tr>
                                <td class="flex justify-center">
                                    <img src="{{ $product->img }}">
                                    {{--                            <img src="{{$product->img}}"> --}}
                                </td>

                                <td>{{ $product->name }}</td>
                                <td class="">{{ $product->count }}</td>
                                <td>{{ $product->total_price }}</td>
                            </tr>
                        @endforeach

                    </table>
                    <div class="w-full h-24 pt-6 pr-4 mt-10 bg-gray-50">
                        <h1 class="text-4xl text-end">{{ $price }}₩</h1>
                    </div>

                    <div>
                        <h1>{{ Auth::user()->name }}</h1>
                        <h1>{{ Auth::user()->email }}</h1>
                        <h1>{{ Auth::user()->phone }}</h1>
                    </div>

                @endif
                <form class="mt-10" method="POST" action="{{ route('order_success') }}">
                    <!-- Postal Code -->
                    @csrf
                    <x-text-input type="hidden" name="dd" value="{{ json_encode($products_info) }}" />
                    <div>
                        <x-input-label for="Postal code" :value="__('Postal code')" />

                        <x-text-input id="postal_code" class="block w-full mt-1" type="text" name="postal_code"
                            :value="old('postal_code')" required autofocus />

                        <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                    </div>

                    <!-- Address -->
                    <div class="mt-4">
                        <x-input-label for="Address" :value="__('Address')" />

                        <x-text-input id="address" class="block w-full mt-1" type="text" name="address"
                            :value="old('address')" required />

                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <x-primary-button class="ml-4">
                            {{ __('Order') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
