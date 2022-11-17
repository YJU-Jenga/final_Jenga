<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    @endpush

    {{-- 네비게이션 바 --}}
    {{-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- --}}

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('상품') }}
        </h2>
    </x-slot>
    <div class="container flex px-12 py-8 mx-auto space-x-4">

        {{-- image slider --}}
        {{-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- --}}

        <div class="container flex">
            <div class="swiper mySwiper w-96 h-96">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img class="object-cover w-96 h-96"
                            src="https://cdn.sisaweek.com/news/photo/202103/142725_136401_837.jpg" alt="image" />
                    </div>
                    <div class="swiper-slide">
                        <img class="object-cover w-96 h-96"
                            src="https://cdn.sisaweek.com/news/photo/202103/142725_136401_837.jpg" alt="image" />
                    </div>
                    <div class="swiper-slide">
                        <img class="object-cover w-96 h-96"
                            src="https://cdn.sisaweek.com/news/photo/202103/142725_136401_837.jpg" alt="image" />
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        {{-- options --}}
        {{-- ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- --}}

        <div class="container ">
            <h1 class="py-5 text-3xl font-bold">쿼카</h1>
            <h1 class="py-2 text-2xl text-red-400">300,000</h1>
            <select name="성별" id="sex" class="rounded-lg">
                <option value="blank">- [필수]옵션을 선택해 주세요 -</option>
                <optgroup label="------------------------">
                    <option value="male">남</option>
                    <option value="female">여</option>
                </optgroup>
            </select>
            <div class="container mx-auto">
                <div class="flex my-6">
                    <div
                        class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                        총 상품금액(수량) : 0원(0개)
                    </div>
                </div>
            </div>
            <button
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">주문</button>
            <button
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">장바구니</button>
        </div>
    </div>

    @push('scripts')
        <!-- Swiper JS, 이미지 슬라이드 동작을 위함 -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper(".mySwiper", {
                cssMode: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                },
                mousewheel: true,
                keyboard: true,
            });
        </script>
    @endpush

</x-app-layout>

{{-- 격리 --}}
{{-- @if ($message = Session::get('success'))
                <div class="p-4 mb-3 bg-green-400 rounded">
                    <p class="text-green-800">{{ $message }}</p>
                </div>
            @endif --}}
