<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Auth;

/**
 * @resource User
 *
 * The user routes.
 */
class UserController extends Controller
{
    /**
     * Show
     *
     * Show the given single user.
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Me
     *
     * Show the logged in user.
     *
     * @return UserResource
     */
    public function me()
    {
        return $this->show(Auth::user());
    }
}
