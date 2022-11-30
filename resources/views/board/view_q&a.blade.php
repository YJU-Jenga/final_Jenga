<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

$post = $posts[0];

$comments = DB::table('comments')
    ->select(['comments.id', 'comments.user_id', 'comments.content', 'comments.created_at', 'users.name'])
    ->leftJoin('users', 'comments.user_id', '=', 'users.id')
    ->leftJoin('posts', 'comments.post_id', '=', 'posts.id')
    ->where('comments.post_id', '=', $post->id)
    ->orderBy('posts.created_at', 'desc')
    ->get();
// dd($post);
?>

<x-app-layout>
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="mt-4 mb-8 ml-2 text-xl font-semibold leading-tight text-gray-800">
                        {{ __('Q&A') }}
                    </h2>

                    {{-- 글 --}}
                    <div class="flex flex-col ml-2">
                        <h1 class="text-4xl">{{ $post->title }}</h1>
                        <div class="flex justify-between mt-4 mb-2">
                            <div class="flex">
                                <svg class="w-5 h-5" style="enable-background:new 0 0 24 24;" version="1.1" viewBox="0 0 24 24" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="info" />
                                    <g id="icons">
                                        <g id="user">
                                            <ellipse cx="12" cy="8" rx="5" ry="6" />
                                            <path d="M21.8,19.1c-0.9-1.8-2.6-3.3-4.8-4.2c-0.6-0.2-1.3-0.2-1.8,0.1c-1,0.6-2,0.9-3.2,0.9s-2.2-0.3-3.2-0.9    C8.3,14.8,7.6,14.7,7,15c-2.2,0.9-3.9,2.4-4.8,4.2C1.5,20.5,2.6,22,4.1,22h15.8C21.4,22,22.5,20.5,21.8,19.1z" />
                                        </g>
                                    </g>
                                </svg>
                                <h1>&nbsp{{ $post->name }}&nbsp&nbsp&nbsp</h1>
                            </div>

                            <div class="flex">
                                <svg class="w-5 h-5" style="enable-background:new 0 0 32 32;" id="Layer_1" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="calendar_1_">
                                        <path d="M29.334,3H25V1c0-0.553-0.447-1-1-1s-1,0.447-1,1v2h-6V1c0-0.553-0.448-1-1-1s-1,0.447-1,1v2H9V1   c0-0.553-0.448-1-1-1S7,0.447,7,1v2H2.667C1.194,3,0,4.193,0,5.666v23.667C0,30.806,1.194,32,2.667,32h26.667   C30.807,32,32,30.806,32,29.333V5.666C32,4.193,30.807,3,29.334,3z M30,29.333C30,29.701,29.701,30,29.334,30H2.667   C2.299,30,2,29.701,2,29.333V5.666C2,5.299,2.299,5,2.667,5H7v2c0,0.553,0.448,1,1,1s1-0.447,1-1V5h6v2c0,0.553,0.448,1,1,1   s1-0.447,1-1V5h6v2c0,0.553,0.447,1,1,1s1-0.447,1-1V5h4.334C29.701,5,30,5.299,30,5.666V29.333z" fill="#333332" />
                                        <rect fill="#333332" height="3" width="4" x="7" y="12" />
                                        <rect fill="#333332" height="3" width="4" x="7" y="17" />
                                        <rect fill="#333332" height="3" width="4" x="7" y="22" />
                                        <rect fill="#333332" height="3" width="4" x="14" y="22" />
                                        <rect fill="#333332" height="3" width="4" x="14" y="17" />
                                        <rect fill="#333332" height="3" width="4" x="14" y="12" />
                                        <rect fill="#333332" height="3" width="4" x="21" y="22" />
                                        <rect fill="#333332" height="3" width="4" x="21" y="17" />
                                        <rect fill="#333332" height="3" width="4" x="21" y="12" />
                                    </g>
                                </svg>
                                <h1>&nbsp{{ Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}&nbsp&nbsp&nbsp</h1>
                                <svg class="w-6 h-6" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" width="512px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g>
                                        <path d="M256,128c-81.9,0-145.7,48.8-224,128c67.4,67.7,124,128,224,128c99.9,0,173.4-76.4,224-126.6   C428.2,198.6,354.8,128,256,128z M256,347.3c-49.4,0-89.6-41-89.6-91.3c0-50.4,40.2-91.3,89.6-91.3s89.6,41,89.6,91.3   C345.6,306.4,305.4,347.3,256,347.3z" />
                                        <g>
                                            <path d="M256,224c0-7.9,2.9-15.1,7.6-20.7c-2.5-0.4-5-0.6-7.6-0.6c-28.8,0-52.3,23.9-52.3,53.3c0,29.4,23.5,53.3,52.3,53.3    s52.3-23.9,52.3-53.3c0-2.3-0.2-4.6-0.4-6.9c-5.5,4.3-12.3,6.9-19.8,6.9C270.3,256,256,241.7,256,224z" />
                                        </g>
                                    </g>
                                </svg>
                                <h1>&nbsp{{ $post->hit }}</h1>
                            </div>

                        </div>
                        <hr>
                        <div class="max-h-full pt-8 mb-20">
                            @if ($post->img != null)
                            <img class="mb-6" src="/storage/images/{{ $post->img }}" alt="" />
                            @endif
                            <p class="">{{ $post->content }}</p>
                        </div>
                    </div>

                    <div class="">
                        @foreach ($comments as $comment)
                        <div class="p-5 ml-2 bg-gray-100 border-b-amber-500">
                            <h1>{{ $comment->name }}</h1>
                            <h1 class="mb-3">{{ Carbon\Carbon::parse($comment->created_at)->format('Y-m-d') }}</h1>
                            <div class="flex">
                                <p class="text-red-600">✓</p>
                                <h1 class="ml-2"> {{ $comment->content }}</h1>
                            </div>
                            @if (Auth::user()->id == $comment->user_id)
                            <form method="get" action="/comment_delete/{{ $comment->id }}">
                                <input type="hidden" id="id" name="id" value="{{ $post->id }}">
                                <input type="hidden" id="board_id" name="board_id" value="{{ $post->board_id }}">
                                <x-primary-button class="ml-4">
                                    {{ __('삭제') }}
                                </x-primary-button>
                            </form>
                            <form method="get" action="/comment_update/{{ $comment->id }}">
                                <input type="hidden" id="id" name="id" value="{{ $post->id }}">
                                <input type="hidden" id="board_id" name="board_id" value="{{ $post->board_id }}">
                                <x-primary-button class="ml-4">
                                    {{ __('수정') }}
                                </x-primary-button>
                            </form>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @auth()
                    @if (Auth::user()->permission == 1 && $post->state == 0)
                    <div class="px-2 mx-auto mt-6 text-right">
                        <form method="post" action="/comment_write">
                            @csrf
                            <textarea name="content" id="content" class="w-full h-32 border border-blue-300 resize-none" Placeholder="답글을 작성해 주세요." required></textarea>
                            <x-primary-button class="mt-4 ml-4">
                                <input type="hidden" id="id" name="id" value="{{ $post->id }}">
                                <input type="hidden" id="board_id" name="board_id" value="{{ $post->board_id }}">
                                <input type="submit" value="작성">
                            </x-primary-button>
                        </form>
                    </div>
                    @endif
                    @endauth
                </div>
            </div>
            <div class="flex items-center justify-end mt-4">
                <a href="{{ route('q&a') }}">
                    <x-primary-button class="ml-4">
                        {{ __('목록') }}
                    </x-primary-button>
                </a>
                @if (Auth::user()->id == $post->user_id)
                <a href="/update_q&a/{{ $post->id }}">
                    <x-primary-button class="ml-4">
                        {{ __('수정') }}
                    </x-primary-button>
                </a>
                <a href="/deleteck_q&a/{{ $post->id }}">
                    <x-primary-button class="ml-4">
                        {{ __('삭제') }}
                    </x-primary-button>
                </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>