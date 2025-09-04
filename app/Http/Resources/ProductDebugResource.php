<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDebugResource extends JsonResource
{
    // tambah atribute addtional
    // dan otomatis attribute ini akan ditambah ke data array dibawah
    // dan akan sejajar dengan data wrap
    // tapi ini statis
    // public $additional = [
    //     // isi daya array author nya Fadilah Stations
    //     "author" => "Fadilah Stations"
    // ];

    public static $wrap = "data";

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return [
        //     "id" => $this->id,
        //     "name" => $this->name,
        //     "price" => $this->price
        // ];
        return [
            "author" => "Fadilah Stations", // ini dinamis, atribute addtional
            "server_time" => now()->toDateTimeString(), // waktu saat ini di server
            "data" => [
                "id" => $this->id,
                "name" => $this->name,
                "price" => $this->price
            ]
        ];
    }
}
