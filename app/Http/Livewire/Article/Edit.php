<?php

namespace App\Http\Livewire\Article;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Rules\SlugRule;
use App\Models\Article;
use App\Models\Auteur;
use App\Models\Etiquette;

class Edit extends Component
{
    use WithFileUploads;
    public Article $article;

    // les id des <select> ont besoin d'être copiés dans des attributs directs
    // (wire:model="article.type.id" fonctionne mal)
    public $auteur;

    public $newIllustration; //type Livewire\TemporaryUploadedFile
    public $illustrationUrl; //type Livewire\TemporaryUploadedFile
    public $auteurs;

    public $etiquettes;

    private function getSlugRule()
    {
        return new SlugRule($this->article->id, Article::class);
    }

    protected $rules = [
            'article.titre' => 'required|string|min:2|max:100',
            'article.soustitre' => 'string|min:2|max:100',
            'article.slug' => 'required',
            'article.debutpublication' => 'required',
            'article.finpublication' => '',
            'article.article' => '',
            'auteur'     => 'required|integer',
    ];
    public $titreComponent = "article edit form";

    public function mount(Article $article)
    {
        $this->article = $article;
        if ($article->auteur)
        {
            $this->auteur = $article->auteur->id;
        }

        $this->auteurs = Auteur::all();

        if ($article->getMedia('illustration')->first())
        {
            $this->illustrationUrl = $article->getMedia('illustration')->first()->getUrl();
        }

        $tableau = array();
        foreach($article->etiquettes()->get() as $etiq)
        {
            $tableau[] = $etiq->nom;
        }
        $this->etiquettes = implode(', ', $tableau);
        //$this->adjustSlug(); //sinon écrase le slug !
    }
    public function render()
    {
        return view('livewire.article.edit');
    }
    public function submit()
    {
        $data = $this->validate($this->rules);
        $this->validate(['article.slug' => $this->getSlugRule()]);

        // Ce code n'est pas exécuté si les règles ne sont pas validées ci-dessus.
        $auteur = Auteur::findOrFail($data['auteur']);
        $this->article->auteur()->associate($auteur);

        $this->article->save();

        /* Étiquettes */
        // D'abord détacher toutes les étiquettes
        $this->article->etiquettes()->detach();
        foreach(explode(',', $this->etiquettes) as $tag)
        {
            $t = trim($tag);
            $etiq = Etiquette::firstOrCreate([
                'nom' => $t
            ]);
            $this->article->etiquettes()->save($etiq);
        }


        /* Mettre à jour la collection d'image : vider puis ajouter l'image
         * nouvellement postée 
         */
        if ($this->newIllustration)
        {
            $this->article->clearMediaCollection('illustration');
            $this->article->addMedia($this->newIllustration->getRealPath())
                      ->usingName($this->newIllustration->getClientOriginalName())
                      ->toMediaCollection('illustration');
        }

        return redirect()->route('object', ['slug' => $this->article->slug]);
    }
    public function validateSlug()
    {
        $this->validate(['article.slug' => $this->getSlugRule()]);
    }
    public function adjustSlug()
    {
        $this->article->slug = \Util::slugify($this->article->titre);
        $this->validateSlug();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedNewIllustration()
    {
        $this->validate([
            'newIllustration' => 'image|max:1024',
        ]);
    }
}
