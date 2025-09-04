<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    // wrap response nya dengan array "data"
    public static $wrap = "data";
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return dalam bentuk data 
        return [
            // dari ProductResource, dengan collection
            "data" => ProductResource::collection($this->collection)
        ];
    }

    // resource response
    // memanipulasi data responsenya
    public function withResponse(Request $request, JsonResponse $response)
    {
        // kita tambahkan header
        $response->header("X-Powered-By", "Fadilah Stations");
    }
}
