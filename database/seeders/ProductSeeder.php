<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $products = [
            [
                'name' => 'Fesh milk 250ml',
                'price' => 250,
                'description' => 'lorem ipsum',
                'stock' => 2,
                'type' => 1,
                'img' => 'https://media.bunjang.co.kr/product/203349854_1_1666684965_w360.jpg'
            ],
            [
                'name' => '12 Egs',
                'price' => 6,
                'description' => 'lorem ipsum',
                'stock' => 2,
                'type' => 0,
                'img' => 'https://media.bunjang.co.kr/product/203349854_1_1666684965_w360.jpg'
            ]
        ];
        Product::insert($products);
    }
}
