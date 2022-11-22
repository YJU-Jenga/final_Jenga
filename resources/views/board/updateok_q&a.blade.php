<x-app-layout>
    <div class="py-6">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            수정 되었습니다.
          </div>
        </div>
        <div class="flex items-center justify-center mt-4">
          <a href="{{ route('q&a') }}">
            <x-primary-button class="ml-4">
              {{ __('돌아가기') }}
            </x-primary-button>
          </a>
        </div>
      </div>
    </div>
  </x-app-layout>