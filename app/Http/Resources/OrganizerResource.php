<?php

namespace App\Http\Resources;

use App\Models\Organizer;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class OrganizerResource
 * @package App\Http\Resources
 * @mixin Organizer
 */
class OrganizerResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'telephone' => $this->telephone,
            'email' => $this->email
        ];
    }
}
