<?php

namespace App\Http\Resources;

use App\Models\Event;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class EventResource
 * @package App\Http\Resources
 * @mixin Event
 */
class EventResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->loadShow();

        return [
            'id' => $this->id,
            'key' => $this->key,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image ? storage_public_url($this->image) : null,
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at,
            'price' => $this->price,
            'price_type' => $this->price_type,
            'capacity' => $this->capacity,
            'age_limit' => $this->age_limit,
            'organizer' => $this->organizer ? new OrganizerResource($this->organizer) : null,
            'address' => new AddressResource($this->address),
            'categories' => CategoryResource::collection($this->categories)
        ];
    }
}
