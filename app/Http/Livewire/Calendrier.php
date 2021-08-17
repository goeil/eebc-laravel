<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Evenement;

class Calendrier extends Component
{
    public $events = '';
    public function render()
    {
        $evenements = Evenement::all();
        $collection = array();
        foreach ($evenements as $e)
        {
            $element = [
                'id' => $e->id,
                'title' => $e->titre,
                'start' => $e->horaire,
                'url' => $e->slug,
            ];
            $collection[] = $element;
        }
        $this->events = json_encode($collection);
        return view('livewire.calendrier');
    }
}
