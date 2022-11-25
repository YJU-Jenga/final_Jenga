<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        for($i = 0; $i < 2; $i++) {
            $order = [
                'id' => 1,
                'user_id' => 1,
                'product_id' => 1,
                'cart_id' => 1,
                'postal_code' => '123-456',
                'address' => 'lorem ipsum dolor sit amet',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            \Illuminate\Support\Facades\DB::table('orders')->insert($order);
        }
    }
}