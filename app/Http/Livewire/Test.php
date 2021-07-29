<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Test extends Component
{
    public $horaire;
    public $type;
    public function render()
    {
        return view('livewire.test')->layout('layouts.test');
    }
}
