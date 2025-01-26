<?php

namespace App\Http\Resources\UserProfiles;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfilesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        JsonResource::withoutWrapping();
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'avatar'  => $this->avatar,
            'user_id' => $this->user_id
        ];
    }
}
