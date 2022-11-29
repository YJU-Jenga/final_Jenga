<?php
$post = $posts[0]
?>

<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Q&A 삭제') }}
    </h2>
  </x-slot>
  <div class="py-6">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          정말로 삭제 하시겠습니까?
        </div>
      </div>
      <div class="flex items-center justify-center mt-4">
        <a href="{{ route('q&a') }}">
          <x-primary-button class="ml-4">
            {{ __('돌아가기') }}
          </x-primary-button>
        </a>
        <a href="/delete_q&a/{{$post->id}}">
          <x-primary-button class="ml-4">
            {{ __('삭제하기') }}
          </x-primary-button>
        </a>
      </div>
    </div>
  </div>
</x-app-layout>