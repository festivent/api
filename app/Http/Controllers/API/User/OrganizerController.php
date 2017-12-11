<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\Organizer\StoreRequest;
use App\Http\Resources\OrganizerResource;
use Auth;

/**
 * @resource UserOrganizer
 *
 * The organizer routes for logged in user.
 */
class OrganizerController extends Controller
{
    /**
     * List
     *
     * List organizers of logged in user.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return OrganizerResource::collection(
            Auth::user()->organizers
        );
    }

    /**
     * Store
     *
     * Store the given organizer for logged in user.
     *
     * @param StoreRequest $request
     * @return OrganizerResource
     */
    public function store(StoreRequest $request)
    {
        $organizer = Auth::user()->organizers()->create(
            $request->validated()
        );

        return new OrganizerResource($organizer);
    }
}
