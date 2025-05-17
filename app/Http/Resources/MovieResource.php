<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $details = $this->details;
        return [
            'id' => $this->id,
            'title' => $details->title,
            'description' => $details->description,
            'genre' => $details->genre,
            'language' => $details->language,
            'release_year' => $details->release_year,
            'director' => $details->director,
            'rating' => $details->rating,
            'views' => $details->views,
            'poster_path' => $this->poster_path,
            'file_path' => $this->file_path,
        ];
    }
}
