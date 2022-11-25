<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
<<<<<<< HEAD
            {{ __('dashboard') }}
=======
            {{ __('홈') }}
>>>>>>> ced5d6b (clean push)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
<<<<<<< HEAD
                    회원 정보 수정
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    문의 내역 확인
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    주문 내역 확인
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    몰?루
=======
                    {{ Auth::user()->name }}님 안녕하세요
>>>>>>> ced5d6b (clean push)
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
</x-app-layout>
=======
</x-app-layout>
>>>>>>> ced5d6b (clean push)
