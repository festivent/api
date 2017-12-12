<?php

namespace App\Http\Resources;

use App\Models\Event;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class EventsCollection
 * @package App\Http\Resources
 * @mixin Event
 */
class EventsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description ? substr($this->description, 0, 127) : '',
            'image' => $this->image ? storage_public_url($this->image) : null,
            'started_at' => $this->started_at,
            'price' => $this->price,
            'price_type' => $this->price_type
        ];
    }
}
