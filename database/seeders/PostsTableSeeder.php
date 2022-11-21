<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 0; $i < 30; $i++) {
            $post = [
                'user_id' => 1,
                'board_id' => 1,
                'title' => '제목'.$i,
                'content' => '내용'.$i,
                'secret' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            \Illuminate\Support\Facades\DB::table('posts')->insert($post);
        }
        for($i = 0; $i < 30; $i++) {
            $post = [
                'user_id' => 1,
                'board_id' => 2,
                'title' => '제목'.$i,
                'content' => '내용'.$i,
                'secret' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            \Illuminate\Support\Facades\DB::table('posts')->insert($post);
        }
        for($i = 0; $i < 30; $i++) {
            $post = [
                'user_id' => 1,
                'board_id' => 3,
                'title' => '제목'.$i,
                'content' => '내용'.$i,
                'secret' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            \Illuminate\Support\Facades\DB::table('posts')->insert($post);
        }
    }
}

// 1 = 상품 문의 게시판
// 2 = Q & A 게시판
// 3 = 후기 게시판