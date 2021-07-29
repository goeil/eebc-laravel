<?php

namespace App\Http\Livewire\Evenement;

use Livewire\Component;

class Showline extends Component
{
    public $evenement;
    public function render()
    {
        return view('livewire.evenement.showline');
    }
}
