<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'urgent' => $this->urgent,
            'content' => $this->content,
            'user' => UserResource::make($this->whenLoaded('user')),
            'category' => CategoryResource::make($this->whenLoaded('category')),
        ];
    }
}
