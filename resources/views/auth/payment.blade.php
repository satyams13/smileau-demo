<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('payment-charge') }}" id="paymentForm">
            @csrf

            <div class="form-group">
                <x-jet-label for="name" value="{{ __('Cardholder Name') }}" />
                <x-jet-input id="card-holder-name" class="block mt-1 w-full" type="text" />
                <br>
            </div>

            <div class="form-group">
                <x-jet-label for="name" value="{{ __('Amount') }}" />
                <x-jet-input id="card-holder-name" class="block mt-1 w-full" type="text" disabled :value="$amount" />
                <br>
            </div>

            <div class="form-group">
                <!-- Stripe Elements Placeholder -->
                <div id="card-element"></div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4" id="card-button" type="button" data-secret="{{ $intent->client_secret }}">
                    {{ __('Pay Now') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
