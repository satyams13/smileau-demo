<x-jet-form-section submit="">
    <x-slot name="title">
        {{ __('Payment Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Payment information of your account.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Card Number -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="card-number" value="{{ __('Card Number') }}" />
            <x-jet-input id="card-number" type="text" class="mt-1 block w-full" value="XXXX-XXXX-XXXX-{{ $user->card_last_four }}" disabled/>
            <x-jet-input-error for="card-number" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-4 mt-6">
            <x-jet-button onclick="getTransactions()">
                {{ __('Transactions') }}
            </x-jet-button>
        </div>
        <div class="col-span-12">
            <div id="transitions"></div>
        </div>
    </x-slot>
</x-jet-form-section>
