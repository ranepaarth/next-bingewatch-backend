<?php

namespace App\Http\Resources\Plans;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlansResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'plan_id'           => $this->plan_id,
            'name'              => $this->name,
            'slug'              => $this->slug,
            'price'             => $this->price,
            'av_quality'        => $this->av_quality,
            'resolution'        => $this->resolution,
            'resolution_name'   => $this->resolution_name,
            'supported_devices' => $this->device_support,
        ];
    }
}
