<?php

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/categories/{id}", function ($id) {
    $category = Category::findOrFail($id); // tekukan/gagal model id 
    // ini sebuah resource, laravel tau!!
    return new CategoryResource($category); // return kan categoryResource nya, modelnya category
});

Route::get('/categories', function () {
    $categories = Category::all(); // ambil semua data category
    return CategoryResource::collection($categories); // static method collection
});

Route::get('/categories-custom', function () {
    $categories = Category::all(); // ambil semua data category
    return new CategoryCollection($categories); // static method collection
});


Route::get('/products/{id}', function ($id) {
    $products = \App\Models\Product::find($id); // ambil data berdasarkan id
    return (new ProductResource($products));
});
// Route::get('/products/{id}', function ($id) {
//     $product = \App\Models\Product::find($id); // ambil data berdasarkan id
//     $product->load("category"); // muat data model category 
//     return (new ProductResource($product)) // kembalikan data 
//         ->response() // response
//         ->header("X-Powered-By", "Fadilah Stations"); // header
// });

// akan di wrap dalam data, nanti data array nya
Route::get('/products', function () {
    $products = \App\Models\Product::with('category')->get(); // ambil product dengan category one to many
    return new ProductCollection($products); // kembalikan product collection
});

// product pagging
Route::get('/products-paging', function (Request $request) {
    $page = $request->get('page', 1); // ambil page dari request page ke-1
    $products = \App\Models\Product::paginate(perPage: 2, page: $page); // gunakan product paginate, per page 2 saja, dan page yang akan di ambil dari parameter $products
    return new ProductCollection($products); // gunakan product collection
});

// Route::get('/products-debug/{id}', function ($id) {
//     $product = \App\Models\Product::find($id);
//     return new ProductDebugResource($product);
// });
