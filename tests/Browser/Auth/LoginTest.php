<?php

namespace Tests\Browser\Auth;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use App\Models\User;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * User can login successfully
     *
     * @return void
     */
    public function testUserCanLoginSuccessfully()
    {
        $user = User::factory()->create(['stripe_id' => 'cus_454ds578d7s8']);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('@login-email', $user->email)
                    ->type('@login-password', 'password')
                    ->press('@login-button')
                    ->assertPathIs('/dashboard');

            $browser->screenshot('auth/login/user_can_successfully_login');
        });
    }

    /**
     * User can not login with wrong credentials
     *
     * @return void
     */
    public function testUserCanNotLoginWithWrongCredentials()
    {
        $user = User::factory()->create();

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('@login-email', $user->email)
                    ->type('@login-password', 'wrongpassword')
                    ->press('@login-button')
                    ->assertPathIs('/login');

            $browser->screenshot('auth/login/user_can_not_login_with_wrong_credentials');
        });
    }
}
