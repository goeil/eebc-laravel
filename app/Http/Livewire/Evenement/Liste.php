<?php

namespace App\Http\Livewire\Evenement;

use App\Models\Evenement;
use Livewire\Component;
use Livewire\WithPagination;

class Liste extends Component
{
    public string $recherche = "";

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $search = '%' . $this->recherche . '%';
        $evenements = Evenement::where('titre', 'like', $search)
            ->orderBy('horaire','desc')->paginate(10);
        return view('livewire.evenement.liste', ['evenements' => $evenements]);
    }
}

