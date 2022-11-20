@extends('master')

{{-- 1 --}}
{{-- resources/views/master.blade.php의 <head></head> 안에 --}}
{{-- @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/main.js']) --}}
{{-- 추가해주세요~~ --}}

{{-- 2 --}}
{{-- extends('master') -> mater.blade.php에 네비게이션바 있어서 그거를 확장해서 사용하는 방향으로 해봤습니닷~~! --}}

{{-- 3 --}}
{{-- - 일단 내용물 어떻게 작성할 지 생각을 못하고 + 이미지도 딱히 할 게 없어서 샘플로 채웠습니다! 나중에 회의하고 채워봐욧,, --}}



@section('content')
    <figure id="section" class="flex flex-col items-center w-screen h-screen mt-16">
        <img class="w-3/4 h-80" src="/main_image.jpeg">
        <p class="mt-16 text-4xl tracking-widest">아직 GNB와 병합을 안해서</p>
        <p class="mt-8 text-xl tracking-widest text-gray-500">첫화면은 스크롤이 잘 안 될 거예요</p>
        <p class="mt-4 text-xl tracking-widest text-gray-500">일단은 깃허브에 올려볼게요</p>
    </figure>
    <figure id="section" class="flex flex-col items-center justify-center w-screen h-screen">
        <img class="w-3/4 h-80" src="/main_image.jpeg">
        <p class="mt-16 text-5xl tracking-widest text-red-500">아름다운 여러분들</p>
        <p class="mt-8 text-xl tracking-widest text-gray-800">우리의 머리털은 지키고</p>
        <p class="mt-4 text-xl tracking-widest text-gray-500">맘뉼이의 탈모를 기원해봐요</p>
    </figure>
    <figure id="section" class="flex flex-col items-center justify-center w-screen h-screen">
        <img class="w-3/4 h-80" src="/main_image.jpeg">
        <p class="mt-16 text-4xl tracking-widest">우리들은 시크동현인형을 팝니다</p>
        <p class="mt-8 text-xl tracking-widest text-gray-500">성별은 여자예요</p>
        <p class="mt-4 text-xl tracking-widest text-gray-500">커스터마이징이 가능하답니다</p>
        <p class="mt-4 text-xl tracking-widest text-red-300">이름도 마음대로 바꿀 수 있어요!</p>
    </figure>
    <figure id="section" class="flex flex-col items-center justify-center w-screen h-screen">
        <img class="w-3/4 h-80" src="/main_image.jpeg">
        <p class="mt-16 text-4xl tracking-widest">여러분 저 어도비 결제 못해서</p>
        <p class="mt-8 text-xl tracking-widest text-gray-500">작품을 못 만들어요</p>
        <p class="mt-4 text-xl tracking-widest text-gray-500">2만원만 주세요</p>
        <p class="mt-4 text-xl tracking-widest text-gray-500">응애~~~~~</p>
    </figure>
    @include('footer')
@endsection
