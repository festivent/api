<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @param User $user
     * @return string
     */
    public function authToken(User $user)
    {
        return JWTAuth::fromUser($user);
    }

    /**
     * @param array $attributes
     * @return User
     */
    public function fakeUser(array $attributes = [])
    {
        return factory(User::class)->create($attributes);
    }
}
