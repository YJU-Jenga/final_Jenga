<?php
  $message = '';
  $password = $posts->password;
?>

<x-app-layout>
  <div class="py-6">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          해당 게시글은 비밀글 입니다. 비밀번호를 입력해주세요.

        @if($posts->board_id == 1)
        <form action="/view_product_inquiry/{{$id}}">
            <div class="items-center p-6 felx">
              <label for="password">비밀번호:4자리</label>
              <input id="password" class="text-sm font-medium text-gray-700 felx" type="password" placeholder="비밀번호" required autofocus/>
              <button class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25"
              type="submit" onclick="comfirm()">입력</button>
            </div>
        </form>

        @elseif($posts->board_id == 2)
        <form action="/view_q&a/{{$id}}">
            <div class="items-center p-6 felx">
              <label for="password">비밀번호:4자리</label>
              <input id="password" class="text-sm font-medium text-gray-700 felx" type="password" placeholder="비밀번호" required autofocus/>
              <button class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25"
              type="submit" onclick="comfirm()">입력</button>
            </div>
        </form>

        @elseif($posts->board_id == 3)
        <form action="/view_item_use/{{$id}}" >
            <div class="items-center p-6 felx">
              <label for="password">비밀번호:4자리</label>
              <input id="password" class="text-sm font-medium text-gray-700 felx" type="password" placeholder="비밀번호" required autofocus/>
              <button class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25"
              type="submit" onclick="comfirm()">입력</button>
            </div>
        </form>

        @endif
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
    <script>
      function comfirm() {
        if(document.getElementById('password').value == {{$password}}){
          
        } else {
          event.preventDefault();
          alert('비밀번호가 맞지 않습니다.');
        }
      }
    </>
  @endpush
</x-app-layout>