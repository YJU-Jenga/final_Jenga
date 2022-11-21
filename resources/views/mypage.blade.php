<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('마이페이지') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    회원 정보 수정
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    문의 내역 확인
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    주문 내역 확인
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- {{ \App\Models\User::find(1)->post[0]['title'] }} -->
                    @foreach (\App\Models\User::find(1)->post as $post)
                        <p>게시글 {{ $post->id }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
