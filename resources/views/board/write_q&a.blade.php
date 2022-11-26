<?php

use \Illuminate\Support\Facades\DB;
?>

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Q&A 작성') }}
    </h2>
  </x-slot>

  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">

          <form method="POST" action="{{ route('write_q&a') }}" enctype="multipart/form-data">
            @csrf
            <div>
              <x-input-label for="title" :value="__('제목')" />

              <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" placeholder="제목" required autofocus />

              <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <div>
              <x-input-label for="content" :value="__('내용')" />
              <textarea id="content" class="block mt-1 w-full" type="text" name="content" required></textarea>
            </div>

            <div class="block" x-data="{ open: false }">
              <div>
                <label for="secret">비밀글 여부 </label>
                <input type="checkbox" id="secret" name="secret" @click="open = ! open">
              </div>
              <div x-show="open" style="display: none;" @click="display: block;">
                <x-input-label for="password" :value="__('비밀번호')" />

                <x-text-input type="password" id="password" class="block mt-1 w-full" type="text" name="password" placeholder="4자리" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
              </div>
            </div>
            <div class="mt-4">
              <x-input-label for="img" :value="__('이미지')" />

              <x-text-input type="file" id="img" class="block w-full mt-1" name="img" accept="image/*" />

              <x-input-error :messages="$errors->get('img')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
              <x-primary-button class="ml-4">
                {{ __('작성') }}
              </x-primary-button>
            </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>