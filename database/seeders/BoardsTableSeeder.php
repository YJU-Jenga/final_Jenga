<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 상품 문의
        $board1 = [
            'board_name' => '상품 문의게시판',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        \Illuminate\Support\Facades\DB::table('boards')->insert($board1);
        
        // Q&A
        $board2 = [
            'board_name' => 'Q&A',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        \Illuminate\Support\Facades\DB::table('boards')->insert($board2);
        
        // 후기 게시판
        $board3 = [
            'board_name' => '후기 게시판',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        \Illuminate\Support\Facades\DB::table('boards')->insert($board3);
    
    }
}

// 1 = 상품 문의 게시판
// 2 = Q & A 게시판
// 3 = 후기 게시판