<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

// @mixin Category
// CategoryResource, merupakan resource untuk model object model category
class CategoryResource extends JsonResource
{
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
            'id' => $this->id, // $this = manggil model, ->id = manggil kolom id nya
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
