<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

use DB;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'payment_method' => ['required', 'string'],
        ])->validate();

        DB::beginTransaction();

        $user = new User;

        try {
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);

            $user->createOrGetStripeCustomer([
                'email' => $user->email
            ]);

            $user->updateDefaultPaymentMethod($input['payment_method']);

            $amount       = env('STRIPE_AMOUNT') * 100;
            $stripeCharge = $user->charge($amount, $input['payment_method']);

            DB::commit();
        } catch (\Exception $e) {

          dd($e);
            DB::rollBack();
        }

        return $user;
    }
}
