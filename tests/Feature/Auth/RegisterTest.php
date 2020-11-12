<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * User can view registration page
     *
     * @throw Exception
     * @return void
     */
    public function testUserCanViewRegistrationPage()
    {
        $response = $this->get('/register');

        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    /**
     * User can register successfully
     *
     * @throw Exception
     * @return void
     */
    public function testUserCanRegisterSuccessfully()
    {
        $response = $this->call('POST', '/register', [
            '_token'                => csrf_token(),
            'name'                  => $this->faker->name,
            'email'                 => $this->faker->email,
            'password'              => 'password',
            'password_confirmation' => 'password',
            'payment_method'        => 'pm_card_visa',
        ]);

        $response->assertRedirect('dashboard');
    }

    /**
     * User can not register without payment
     *
     * @throw Exception
     * @return void
     */
    public function testUserCanNotRegisterWithoutPayment()
    {
        $response = $this->call('POST', '/register', [
            '_token'                => csrf_token(),
            'name'                  => $this->faker->name,
            'email'                 => $this->faker->email,
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/');
    }
}
