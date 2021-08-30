<?php

namespace App\Http\Livewire\Evenement;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TypeEvenement;
use App\Models\LieuEvenement;
use App\Models\OrganisateurEvenement;
use App\Rules\SlugRule;
use App\Models\Evenement;
use App\Models\Etiquette;

class Edit extends Component
{
    use WithFileUploads;
    public Evenement $evenement;

    // les id des <select> ont besoin d'être copiés dans des attributs directs
    // (wire:model="evenement.type.id" fonctionne mal)
    public $type;
    public $lieu;
    public $organisateur;

    public $newIllustration; //type Livewire\TemporaryUploadedFile
    public $illustrationUrl; //type Livewire\TemporaryUploadedFile
    public $newPiecejointe; //type Livewire\TemporaryUploadedFile
    public $piecejointeUrl; //type Livewire\TemporaryUploadedFile
    public $types;
    public $lieux;
    public $organisateurs;

    public $etiquettes;

    private function getSlugRule()
    {
        return new SlugRule($this->evenement->id, Evenement::class);
    }

    protected $rules = [
            'evenement.titre' => 'required|string|min:2|max:100',
            'evenement.slug' => 'required',
            'evenement.horaire' => 'required',
            'evenement.description' => '',
            'type'       => 'required|integer',
            'lieu'       => 'required|integer',
            'organisateur' => 'required|integer',
    ];
    public $titreComponent = "evenement edit form";

    public function mount(Evenement $evenement)
    {
        $this->evenement = $evenement;
        $this->type = $evenement->type->id;
        $this->lieu = $evenement->lieu->id;
        $this->organisateur = $evenement->organisateur->id;

        $this->types = TypeEvenement::all();
        $this->lieux = LieuEvenement::all();
        $this->organisateurs = OrganisateurEvenement::all();

        if ($evenement->getMedia('illustration')->first())
        {
            $this->illustrationUrl = $evenement->getMedia('illustration')->first()->getUrl();
        }
        if ($evenement->getMedia('attachments')->first())
        {
            $this->piecejointeUrl = $evenement->getMedia('attachments')->first()->getUrl();
        }


        $tableau = array();
        foreach($evenement->etiquettes()->get() as $etiq)
        {
            $tableau[] = $etiq->nom;
        }
        $this->etiquettes = implode(', ', $tableau);


        //$this->adjustSlug(); //sinon écrase le slug !
        //$this->slugRule = new SlugRule($this->evenement->id, Evenement::class);
        //dd($this->slugRule);
    }
    public function render()
    {
        return view('livewire.evenement.edit');
    }
    public function submit()
    {
        $data = $this->validate($this->rules);
        $this->validate(['evenement.slug' => $this->getSlugRule()]);
        //$this->validate(['evenement.slug' => new SlugRule($this->evenement->id,)]);

        // Ce code n'est pas exécuté si les règles ne sont pas validées ci-dessus.
        $lieu = LieuEvenement::findOrFail($data['lieu']);
        $organisateur = OrganisateurEvenement::findOrFail($data['organisateur']);
        $type = TypeEvenement::findOrFail($data['type']);
        $this->evenement->lieu()->associate($lieu);
        $this->evenement->type()->associate($type);
        $this->evenement->organisateur()->associate($organisateur);

        $this->evenement->save();

        /* Étiquettes */
        // D'abord détacher toutes les étiquettes
        $this->evenement->etiquettes()->detach();
        foreach(explode(',', $this->etiquettes) as $tag)
        {
            $t = trim($tag);
            $etiq = Etiquette::firstOrCreate([
                'nom' => $t
            ]);
            $this->evenement->etiquettes()->save($etiq);
        }

        /* Mettre à jour la collection d'image : vider puis ajouter l'image
         * nouvellement postée 
         */
        if ($this->newIllustration)
        {
            $this->evenement->clearMediaCollection('illustration');
            $this->evenement->addMedia($this->newIllustration->getRealPath())
                      ->usingName($this->newIllustration->getClientOriginalName())
                      ->toMediaCollection('illustration');
        }

        /* Mettre à jour la collection de pièces jointes : vider puis ajouter la
         * pièce jointe nouvellement postée 
         * //TODO gérer plusieurs pièces jointes
         */
        if ($this->newPiecejointe)
        {
            $this->evenement->clearMediaCollection('attachments');
            $this->evenement->addMedia($this->newPiecejointe->getRealPath())
                      ->usingName($this->newPiecejointe->getClientOriginalName())
                      ->toMediaCollection('attachments');
        }

        return redirect()->route('object', ['slug' => $this->evenement->slug]);
    }

    public function validateSlug()
    {
        $this->validate(['evenement.slug' => $this->getSlugRule()]);
    }
    public function adjustSlug()
    {
        $date = \Date::parse($this->evenement->horaire)->format('Y-m-d');
        $newSlug = $date . '-' . \Util::slugify($this->evenement->titre);
        $this->evenement->slug = $newSlug;
        $this->validateSlug();
    }
    private function getObjectsFromSlug()
    {
        foreach (\App\Http\Controllers\SlugController::$classes as $c)
        {
            $ret = $c['model']::whereSlug($this->evenement->slug)
                ->whereNotIn('id', [$this->id])
                ->get();
            if (count($ret))
            {
                return $ret;
                //$found = true;
                //$break;
            }
        }
        return '';
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
    public function updatedNewPiecejointe()
    {
        $this->validate([
            'newPiecejointe' => '',
        ]);
    }
}
