<?php

use \Illuminate\Support\Facades\DB;

$comment = $comments[0];
?>

<x-app-layout>

  <div class="py-6">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <h2 class="mt-4 mb-8 ml-2 text-xl font-semibold leading-tight text-gray-800">
            {{ __('댓글 수정') }}
          </h2>

          <form method="GET" action="/updateok_comment/{{ $comment->id }}">

            @csrf
            <div>
              <x-input-label for="content" :value="__('내용')" />
              <textarea id="content" class="block w-full mt-1 border-gray-300 rounded-md" type="text" name="content" required>{{ $comment->content }}</textarea>
            </div>
            <div class="flex items-center justify-end mt-4">
              <x-primary-button class="ml-4">
                {{ __('수정') }}
              </x-primary-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>