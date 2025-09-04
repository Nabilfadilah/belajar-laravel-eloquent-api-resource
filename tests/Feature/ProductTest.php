<?php

namespace Tests\Feature;

use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function testProduct()
    {
        // ambil seeder
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $product = Product::first(); // ambil data product pertama

        $this->get("/api/products/$product->id") // get api path
            ->assertStatus(200) // status response
            // ->assertHeader("X-Powered-By", "Fadilah Stations") // header
            ->assertJson([ // data yang sesuai dengan yang di resource
                "value" => [
                    "name" => $product->name,
                    "category" => [
                        "id" => $product->category->id,
                        "name" => $product->category->name,
                    ],
                    "price" => $product->price,
                    // "is_expensive" => $product->price > 1000,
                    "created_at" => $product->created_at->toJSON(),
                    "updated_at" => $product->updated_at->toJSON(),
                ]
            ]);
    }

    // Data wrap collection
    public function testCollectionWrap()
    {
        // ambil seeder
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        // ambil get pat product response
        $response = $this->get('/api/products')
            ->assertStatus(200) // status
            ->assertHeader("X-Powered-By", "Programmer Zaman Now"); // header

        $names = $response->json("data.*.name"); // ambil semua name dari json data dan name
        // iterasi data sampe 5
        for ($i = 0; $i < 5; $i++) {
            self::assertContains("Product $i of Food", $names); // harus ada dalam product name
        }
        for ($i = 0; $i < 5; $i++) {
            self::assertContains("Product $i of Gadget", $names);
        }
    }

    // pagination
    public function testProductPaging()
    {
        // ambil seeder
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        // ambil get pat products-paging
        $response = $this->get('/api/products-paging')
            ->assertStatus(200); // status 200

        // harus ada link, meta, data di browsernya
        self::assertNotNull($response->json("links"));
        self::assertNotNull($response->json("meta"));
        self::assertNotNull($response->json("data"));
    }

    // Aditional Metadata
    public function testAdditional()
    {
        // panggil seeder
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $product = Product::first(); // ambil data product pertama

        // ambil get path products-debug, dengan product id
        $response = $this->get('/api/products-debug/' . $product->id)
            ->assertStatus(200) // status 200
            ->assertJson([ // kembalikan json
                "author" => "Fadilah Stations", // additional attribute, sejajar dengan data
                "data" => [
                    "id" => $product->id,
                    "name" => $product->name,
                    "price" => $product->price,
                ]
            ]);

        self::assertNotNull($response->json("server_time")); // harus ada serveir time
    }
}
