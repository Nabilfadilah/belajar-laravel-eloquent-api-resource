<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ambil semua data setiap category
        Category::all()->each(function (Category $category) {
            // iterasi data 5
            for ($i = 0; $i < 5; $i++) {
                // tambah data product
                $category->products()->create([
                    // data name dan price
                    'name' => "Product $i of $category->name",
                    'price' => rand(100, 1000)
                ]);
            }
        });
    }
}
