<?php
  $message = '';
  $password = $posts->password;


?>

<x-app-layout>
  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          해당 게시글은 비밀글 입니다. 비밀번호를 입력해주세요.
        
        @if($posts->board_id == 1)
        <form action="/view_product_inquiry/{{$id}}">
            <div class="p-6 felx items-center">
              <label for="password">비밀번호:4자리</label>
              <input id="password" class="felx font-medium text-sm text-gray-700" type="password" placeholder="비밀번호" required autofocus/>
              <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
              type="submit" onclick="comfirm()">입력</button>
            </div>
        </form>

        @elseif($posts->board_id == 2)
        <form action="/view_q&a/{{$id}}">
            <div class="p-6 felx items-center">
              <label for="password">비밀번호:4자리</label>
              <input id="password" class="felx font-medium text-sm text-gray-700" type="password" placeholder="비밀번호" required autofocus/>
              <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
              type="submit" onclick="comfirm()">입력</button>
            </div>
        </form>

        @elseif($posts->board_id == 3)
        <form action="/view_item_use/{{$id}}" >
            <div class="p-6 felx items-center">
              <label for="password">비밀번호:4자리</label>
              <input id="password" class="felx font-medium text-sm text-gray-700" type="password" placeholder="비밀번호" required autofocus/>
              <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
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