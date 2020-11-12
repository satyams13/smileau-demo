<?php

namespace Tests\Browser\Auth;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

use Illuminate\Foundation\Testing\WithFaker;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations, WithFaker;

    /**
     * User can register successfully
     *
     * @return void
     */
    public function testUserCanRegisterSuccessfully()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('@register-name', $this->faker->name)
                    ->type('@register-email', $this->faker->email)
                    ->type('@register-password', 'password')
                    ->type('@register-password-confirm', 'password')
                    ->type('@register-cardholder-name', $this->faker->name)
                    ->waitFor('iframe')
                    ->withinFrame('iframe', function($browser){
                        $browser->pause(3000);
                        $browser->keys('input[placeholder="Card number"]', '4242 4242 4242 4242')
                                ->keys('input[placeholder="MM / YY"]', '0424')
                                ->keys('input[placeholder="CVC"]', '123')
                                ->keys('input[placeholder="ZIP"]', '42424')
                                ->waitUntilMissing('iframe');
                    })
                    ->press('@register-button')
                    ->pause(3000)
                    ->assertPathIs('/dashboard');

            $browser->screenshot('auth/register/user_can_successfully_registered');
        });
    }

    /**
     * User can not register without payment
     *
     * @return void
     */
    public function testUserCanNotRegisterWithoutPayment()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('@register-name', $this->faker->name)
                    ->type('@register-email', $this->faker->email)
                    ->type('@register-password', 'password')
                    ->type('@register-password-confirm', 'password')
                    ->type('@register-cardholder-name', $this->faker->name)
                    ->press('@register-button')
                    ->pause(1000)
                    ->assertPathIs('/register');

            $browser->screenshot('auth/register/user_can_not_register_without_payment');
        });
    }

    /**
     * User can view their profile
     *
     * @return void
     */
    public function testUserCanViewProfile()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('@register-name', $this->faker->name)
                    ->type('@register-email', $this->faker->email)
                    ->type('@register-password', 'password')
                    ->type('@register-password-confirm', 'password')
                    ->type('@register-cardholder-name', $this->faker->name)
                    ->waitFor('iframe')
                    ->withinFrame('iframe', function($browser){
                        $browser->pause(3000);
                        $browser->keys('input[placeholder="Card number"]', '4242 4242 4242 4242')
                                ->keys('input[placeholder="MM / YY"]', '0424')
                                ->keys('input[placeholder="CVC"]', '123')
                                ->keys('input[placeholder="ZIP"]', '42424')
                                ->waitUntilMissing('iframe');
                    })
                    ->press('@register-button')
                    ->pause(3000)
                    ->assertPathIs('/dashboard')
                    ->press('@profile-settings')
                    ->press('@profile-edit')
                    ->assertSee('Profile Information');

            $browser->screenshot('user/profile/user_can_view_profile');
        });
    }
}
