<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Auth;

class PaymentInformation extends Component
{
    public $user;

    public function render()
    {
        $this->user     = Auth::user();

        return view('livewire.payment-information');
    }
}
