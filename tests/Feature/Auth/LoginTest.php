<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * User can view login page
     *
     * @throw Exception
     * @return void
     */
    public function testUserCanViewLoginPage()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    /**
     * User can successfully login
     *
     * @throw Exception
     * @return void
     */
    public function testUserCanSuccessfullyLogin()
    {
        $user = User::factory()->create(['stripe_id' => 'cus_454ds578d7s8']);

        $response = $this->call('POST', '/login', [
            '_token'    => csrf_token(),
            'email'     => $user->email,
            'password'  => 'password',
        ]);

        $response->assertRedirect('dashboard');
    }

    /**
     * User can not login with wrong credentials
     *
     * @throw Exception
     * @return void
     */
    public function testUserCanNotLoginWithWorngCredentials()
    {
        $user = User::factory()->create(['stripe_id' => 'cus_454ds578d7s8']);

        $response = $this->call('POST', '/login', [
            'email' => $user->email,
            'password' => 'wrongpassword',
            '_token' => csrf_token()
        ]);

        $response->assertRedirect('/');
    }
}
