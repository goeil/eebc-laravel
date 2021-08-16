<?php

namespace App\Http\Livewire\Message;

use App\Models\Message;
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
        $messages = Message::where('titre', 'like', $search)
            ->orderBy('date','desc')->paginate(10);
        return view('livewire.message.liste', ['messages' => $messages]);
    }
}

