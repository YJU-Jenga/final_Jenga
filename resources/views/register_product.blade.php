<x-app-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a>
        </x-slot>
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('이름')" />

                <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus />

                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- price -->
            <div class="mt-4">
                <x-input-label for="price" :value="__('가격')" />

                <x-text-input id="price" class="block w-full mt-1" type="number" name="price" :value="old('price')" required />

                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('상품설명')" />

                <x-text-input id="description" class="block w-full mt-1" type="text" name="description" :value="old('description')" required />

                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('성별')" />
                <select name="type" id="type" class="block w-full mt-1">
                    <option value="0">남자용</option>
                    <option value="1">여자용</option>
                </select>
            </div>
            <div class="mt-4">
                <x-input-label for="price" :value="__('재고')" />

                <x-text-input id="stock" class="block w-full mt-1" type="number" name="stock" :value="old('stock')" required />

                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="img" :value="__('이미지')" />

                <x-text-input type="file" id="img" class="block w-full mt-1" name="img" accept="image/*" required />

                <x-input-error :messages="$errors->get('img')" class="mt-2" />
            </div>
            <!-- Container (Contact Section) -->
            <div id="contact" class="container mt-5">
                <x-primary-button class="mt-5" type="submit">
                    {{ __('상품 등록') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>
</x-app-layout>