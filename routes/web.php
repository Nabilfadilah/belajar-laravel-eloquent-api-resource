<?php

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/categories/{id}", function ($id) {
    $category = Category::findOrFail($id); // tekukan/gagal model id 
    // ini sebuah resource, laravel tau!!
    return new CategoryResource($category); // return kan categoryResource nya, modelnya category
});
