<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        // Mảng chứa tất cả id của categories
        $categoryID = DB::table('categories')->pluck('id')->toArray();
        $productSeed = [];

        for ($i = 0; $i < 10; $i++) {
            $productSeed[] = [
                'name' => fake() ->name(),
                'price' => fake() ->randomNumber(),
                'quantity' => fake() ->randomNumber(),
                'image' => 'https://cdn.tgdd.vn/Products/Images/42/213031/iphone-12-tim-1-600x600.jpg',
                'category_id' => fake() ->randomElement($categoryID),
                'description' => fake() ->text(),
                'status' => fake() ->numberBetween(0,1),
            ];
        }
        DB::table('products')->insert($productSeed);
    }
}
