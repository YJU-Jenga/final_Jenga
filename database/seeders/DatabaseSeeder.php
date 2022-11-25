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
<<<<<<< HEAD
=======
        $this->call(ProductSeeder::class);
>>>>>>> ced5d6b (clean push)
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
<<<<<<< HEAD

        // sail aritsan db:seed
        // php aritsan db:seed
        // 시딩 할 때  유저가 필요함
        // 게시판을 한 번 만들고나서 주석으로 바꾸기

        // 게시판 생성
        $this->call(BoardsTableSeeder::class);

        // 게시글 생성
        $this->call(PostsTableSeeder::class);
=======
>>>>>>> ced5d6b (clean push)
    }
}
