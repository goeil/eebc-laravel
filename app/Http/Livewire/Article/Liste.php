<?php

namespace App\Http\Livewire\Article;

use App\Models\Article;
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
        $articles = Article::where('titre', 'like', $search)
            ->orderBy('debutpublication','desc')->paginate(10);
        return view('livewire.article.liste', ['articles' => $articles]);
    }
}
