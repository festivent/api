<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountyResource;
use App\Http\Resources\ProvinceResource;
use App\Models\Province;

/**
 * @resource Province
 *
 * The province routes.
 */
class ProvinceController extends Controller
{
    /**
     * List
     *
     * List the available provinces.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function list()
    {
        $provinces = Province::orderBy('name')->get();

        return ProvinceResource::collection($provinces);
    }

    /**
     * Counties
     *
     * List the counties of given province.
     *
     * @param Province $province
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function counties(Province $province)
    {
        return CountyResource::collection(
            $province->counties
        );
    }
}
