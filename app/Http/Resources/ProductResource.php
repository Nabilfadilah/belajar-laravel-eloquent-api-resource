<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

// @mixin Category
// CategoryResource, merupakan resource untuk model object model category
class ProductResource extends JsonResource
{
    public static $wrap = "value"; // API/JSON akan di bungkus dengan value

    /**
     * Resource merupakan representasi dari cara melakukan transformasi dari Model menjadi Array / JSON yang kita inginkan.
     * Class Resource adalah class turunan dari class JsonResource, dan kita perlu mengubah implementasi dari method toArray nya
     * 
     */
    public function toArray(Request $request): array
    {
        // array category
        return [
            // 'id, dll' = key
            "id" => $this->id, // $this = manggil model, ->id = manggil kolom id nya
            "name" => $this->name,
            "category" => new CategorySimpleResource($this->category), // nested ke CategorySimpleResource
            // "category" => new CategorySimpleResource($this->whenLoaded('category')), // nested ke CategorySimpleResource
            "price" => $this->price,
            // "is_expensive" => $this->when($this->price > 1000, true, false),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
