<?php

namespace App\Http\Resources;

use App\Models\Province;
use Illuminate\Http\Resources\Json\Resource;

/**
 * Class ProvinceResource
 * @package App\Http\Resources
 * @mixin Province
 */
class ProvinceResource extends Resource
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
            'name' => $this->name
        ];
    }
}
