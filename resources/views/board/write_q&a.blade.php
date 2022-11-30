<?php

use \Illuminate\Support\Facades\DB;
?>

<x-app-layout>


  <div class="py-6">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <h2 class="mt-4 mb-8 ml-2 text-xl font-semibold leading-tight text-gray-800">
            {{ __('Q&A 작성') }}
          </h2>

          <form method="POST" action="{{ route('write_q&a') }}" enctype="multipart/form-data">
            @csrf
            <div>
              <x-input-label for="title" :value="__('제목')" />

              <x-text-input id="title" class="block w-full mt-1 mb-4" type="text" name="title" placeholder="제목" required autofocus />

              <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
              <x-input-label for="content" :value="__('내용')" />
              <textarea id="content" class="block w-full mt-1 border-gray-300 rounded-md" type="text" name="content" required></textarea>
            </div>

            <div class="mt-4">
              <x-input-label for="img" :value="__('이미지')" />

              <x-text-input type="file" id="img" class="block w-full mt-1" name="img" accept="image/*" />

              <x-input-error :messages="$errors->get('img')" class="mt-2" />
            </div>

            <div class="block mt-6" x-data="{ open: false }">
              <div>
                <label for="secret">비밀글 여부 </label>
                <input type="checkbox" id="secret" name="secret" @click="open = ! open">
              </div>
              <div x-show="open" style="display: none;" @click="display: block;">
                <x-input-label for="password" :value="__('비밀번호')" />

                <x-text-input type="password" id="password" class="block w-full mt-1" type="text" name="password" placeholder="4자리" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
              </div>
            </div>


            <div class="flex items-center justify-end mt-4">
              <x-primary-button class="ml-4">
                {{ __('작성') }}
              </x-primary-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>