<x-app-layout>
  <div class="py-6">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="container flex justify-center">
        <x-slot name="header">
          <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('인형 커스터마이징') }}
          </h2>
        </x-slot>
        <form method="POST" action="{{ route('customizing') }}" enctype="multipart/form-data">
            @csrf
              <div class="mt-3">
                  <x-input-label for="img" :value="__('인형 모델 : gltf, glb')" />

                  <x-text-input type="file" id="img" class="block w-full mt-1" name="img" accept=".gltf, .glb" />

                  <x-input-error :messages="$errors->get('img')" class="mt-2" />
              </div>
            </div>

            <div class="flex items-center justify-end mt-4">
              <x-primary-button class="ml-4">
                {{ __('업로드') }}
              </x-primary-button>
            </div>
          </form>
      </div>
    </div>
  </div>
</x-app-layout>
