<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\Province\StoreRequest;
use App\Http\Resources\ProvinceResource;
use App\Models\Province;
use Auth;

/**
 * @resource UserProvince
 *
 * The province routes for logged in user.
 */
class ProvinceController extends Controller
{
    /**
     * List
     *
     * List provinces of logged in user.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ProvinceResource::collection(
            Auth::user()->provinces
        );
    }

    /**
     * Store
     *
     * Store the given category for logged in user.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $user = Auth::user();
        $province = Province::find($request->get('province_id'));

        if (!$user->provinces->contains($province->id)) {
            $user->provinces()->attach($province->id);
        }

        return response()->json([], 201);
    }

    /**
     * Delete
     *
     * Delete the given category for logged in user.
     *
     * @param Province $province
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Province $province)
    {
        $user = Auth::user();
        $user->provinces()->detach($province->id);

        return response()->json();
    }
}
