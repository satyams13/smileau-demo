@php
    $intent = (new \App\Models\User)->createSetupIntent();
@endphp
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div class="form-group">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4 form-group">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4 form-group">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4 form-group">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4 form-group">
                <x-jet-label for="amount" value="{{ __('Amount') }}" />
                <x-jet-input id="amount" class="block mt-1 w-full" type="text" disabled :value="env('STRIPE_AMOUNT', 20)" />
                <br>
            </div>

            <div class="mt-4 form-group">
                <x-jet-label for="card-holder-name" value="{{ __('Cardholder Name') }}" />
                <x-jet-input id="card-holder-name" class="block mt-1 w-full" type="text" required />
                <br>
            </div>

            <div class="form-group">
                <x-jet-label for="card-element" value="{{ __('Credit or debit card') }}" />
                <div id="card-element">
                  <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display form errors. -->
                <div id="card-errors" class="help-block" role="alert"></div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4" id="card-button" data-secret="{{ $intent->client_secret }}" >
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
