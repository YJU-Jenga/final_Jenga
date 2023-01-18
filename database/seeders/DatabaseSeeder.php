<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // sail artisan db:seed
        // php artisan db:seed
        // 시딩 할 때  유저가 필요함
        // 게시판을 한 번 만들고나서 주석으로 바꾸기
        
        // 게시판 생성
        $this->call(BoardsTableSeeder::class);
        
        // 유저 생성 -> id 1 = 사용자, id 2 = 관리자
        $this->call(UsersSeeder::class);
        

        // 게시글 생성
        $this->call(PostsTableSeeder::class);
        
        // 상품 목록 생성
        // $this->call(ProductSeeder::class);
        // $this->call(ProductSeeder::class);
        
        // 브랜치 연동 테스트

    }
}