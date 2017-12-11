<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin User
 */
class UserResource extends Resource
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
            'email' => $this->email,
            'gender' => $this->gender,
            'birth_at' => $this->birth_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
