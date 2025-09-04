<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testResource()
    {
        // ambil seeder
        $this->seed([CategorySeeder::class]);

        // ambil model Category
        $category = Category::first(); // data category pertama

        $this->get("/api/categories/$category->id") // get api path 
            ->assertStatus(200) // kembalikan status 200
            ->assertJson([ // data yang sesuai dengan yang di resource
                'data' => [
                    'id' => $category->id,
                    'name' => $category->name,
                    'created_at' => $category->created_at->toJSON(),
                    'updated_at' => $category->updated_at->toJSON(),
                ]
            ]);
    }

    // public function testResourceCollection()
    // {
    //     $this->seed([CategorySeeder::class]);

    //     $categories = Category::all();

    //     $this->get("/api/categories")
    //         ->assertStatus(200)
    //         ->assertJson([
    //             'data' => [
    //                 [
    //                     'id' => $categories[0]->id,
    //                     'name' => $categories[0]->name,
    //                     'created_at' => $categories[0]->created_at->toJSON(),
    //                     'updated_at' => $categories[0]->updated_at->toJSON(),
    //                 ],
    //                 [
    //                     'id' => $categories[1]->id,
    //                     'name' => $categories[1]->name,
    //                     'created_at' => $categories[1]->created_at->toJSON(),
    //                     'updated_at' => $categories[1]->updated_at->toJSON(),
    //                 ]
    //             ]
    //         ]);
    // }

    // public function testResourceCollectionCustom()
    // {
    //     $this->seed([CategorySeeder::class]);

    //     $categories = Category::all();

    //     $this->get("/api/categories-custom")
    //         ->assertStatus(200)
    //         ->assertJson([
    //             'total' => 2,
    //             'data' => [
    //                 [
    //                     'id' => $categories[0]->id,
    //                     'name' => $categories[0]->name
    //                 ],
    //                 [
    //                     'id' => $categories[1]->id,
    //                     'name' => $categories[1]->name
    //                 ]
    //             ]
    //         ]);
    // }
}
