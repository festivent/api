<?php

namespace App\Http\Resources;

use App\Models\Address;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class AddressResource
 * @package App\Http\Resources
 * @mixin Address
 */
class AddressResource extends Resource
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
            'address' => $this->address,
            'hint' => $this->hint,
            'province' => new ProvinceResource($this->province),
            'county' => new CountyResource($this->county)
        ];
    }
}
