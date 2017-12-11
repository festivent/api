<?php

namespace Tests\Feature\Controllers\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testGuestCanRegister()
    {
        $email = 'sample@mail.com';

        $this->json('POST', route('api.auth.register'), [
            'name' => 'Foo Bar',
            'email' => $email,
            'password' => 'someS3cret',
            'password_confirmation' => 'someS3cret',
            'gender' => MALE,
            'birth_at' => '1995-03-25'
        ])->assertJsonFragment([
            'token'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $email
        ]);
    }

    /** @test */
    public function testGuestCanLogin()
    {
        $password = 'someS3cret';
        $user = $this->fakeUser([
            'password' => bcrypt($password)
        ]);

        $this->json('POST', route('api.auth.login'), [
            'email' => $user->email,
            'password' => $password
        ])->assertJsonFragment([
            'token'
        ]);
    }
}
