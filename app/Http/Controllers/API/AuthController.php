<?php

namespace App\Http\Controllers\API;

use App\Events\Auth\LoggedIn;
use App\Events\Auth\Registered;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Validation\ValidationException;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * @resource Auth
 *
 * The routes for using authentication.
 */
class AuthController extends Controller
{
    use ThrottlesLogins;

    /**
     * Register
     *
     * Create a new user and get token with this user.
     *
     * @param RegisterRequest $request
     * @return UserResource
     */
    public function register(RegisterRequest $request)
    {
        $attributes = $request->validated();
        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        event(new Registered($user));

        return $this->responseUserWithToken($user, JWTAuth::fromUser($user));
    }

    /**
     * Login
     *
     * Login a user and get token with this user.
     *
     * @param LoginRequest $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(LoginRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->sendLockoutResponse($request);
        }

        if ($token = $this->attemptLogin($request->validated())) {
            /** @var User $user */
            $user = JWTAuth::authenticate($token);

            event(new LoggedIn($user));

            return $this->responseUserWithToken($user, JWTAuth::fromUser($user));
        }

        $this->incrementLoginAttempts($request);

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')]
        ]);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Attempt login by credentials.
     *
     * @param $credentials
     * @return bool
     */
    protected function attemptLogin($credentials)
    {
        try {
            $token = JWTAuth::attempt($credentials);
        } catch (JWTException $exception) {
            return false;
        }

        return $token ?: false;
    }

    /**
     * Response user with token.
     *
     * @param User $user
     * @param $token
     * @return UserResource
     */
    protected function responseUserWithToken(User $user, $token)
    {
        return (new UserResource($user))->additional([
            'token' => $token
        ]);
    }
}
