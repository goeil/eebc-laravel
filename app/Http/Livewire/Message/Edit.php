<?php

namespace App\Http\Livewire\Message;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Rules\SlugRule;
use App\Models\Message;
use App\Models\Auteur;
use App\Models\LivreBiblique;
use App\Models\Etiquette;

class Edit extends Component
{
    use WithFileUploads;
    public Message $message;

    // les id des <select> ont besoin d'être copiés dans des attributs directs
    // (wire:model="message.type.id" fonctionne mal)
    public $auteur;
    public $livrebiblique;

    public $newIllustration; //type Livewire\TemporaryUploadedFile
    public $illustrationUrl; //type Livewire\TemporaryUploadedFile
    public $newPiecejointe; //type Livewire\TemporaryUploadedFile
    public $piecejointeUrl; //type Livewire\TemporaryUploadedFile
    public $auteurs;
    public $livresbibliques;

    public $etiquettes;

    private function getSlugRule()
    {
        return new SlugRule($this->message->id, Message::class);
    }

    protected $rules = [
            'message.titre' => 'required|string|min:2|max:100',
            'message.slug' => 'required',
            'message.date' => 'required',
            'message.description' => '',
            'auteur'        => 'required|integer',
            'livrebiblique' => 'integer',
            'message.reference' => '',
            'message.duree'     => 'integer',
            'message.lien'     => 'string',
            'etiquettes'     => 'string',
    ];
    public $titreComponent = "message edit form";

    public function mount(Message $message)
    {
        $this->message = $message;
        if ($message->auteur)
        {
            $this->auteur = $message->auteur->id;
        }
        if ($message->livrebiblique)
        {
            $this->livrebiblique = $message->livrebiblique->id;
        }
        else
        {
            $this->livrebiblique = -1;
        }

        $this->auteurs = Auteur::all();
        $this->livresbibliques = LivreBiblique::all();

        if ($message->getMedia('illustration')->first())
        {
            $this->illustrationUrl = $message->getMedia('illustration')->first()->getUrl();
        }
        if ($message->getMedia('attachments')->first())
        {
            $this->piecejointeUrl = $message->getMedia('attachments')->first()->getUrl();
        }

        $tableau = array();
        foreach($message->etiquettes()->get() as $etiq)
        {
            $tableau[] = $etiq->nom;
        }
        $this->etiquettes = implode(', ', $tableau);

        //$this->adjustSlug(); //sinon écrase le slug !
    }
    public function render()
    {
        return view('livewire.message.edit');
    }
    public function submit()
    {
        $data = $this->validate($this->rules);
        $this->validate(['message.slug' => $this->getSlugRule()]);

        // Ce code n'est pas exécuté si les règles ne sont pas validées ci-dessus.
        $auteur = Auteur::findOrFail($data['auteur']);
        $this->message->auteur()->associate($auteur);
        if ($data['livrebiblique'] == -1)
        {
            $this->message->livrebiblique()->dissociate();
        }
        else
        {
            $livrebiblique = LivreBiblique::findOrFail($data['livrebiblique']);
            $this->message->livrebiblique()->associate($livrebiblique);
        }


        $this->message->save();

        /* Étiquettes */
        // D'abord détacher toutes les étiquettes
        $this->message->etiquettes()->detach();
        foreach(explode(',', $this->etiquettes) as $tag)
        {
            $t = trim($tag);
            $etiq = Etiquette::firstOrCreate([
                'nom' => $t
            ]);
            $this->message->etiquettes()->save($etiq);
        }


        /* Mettre à jour la collection d'image : vider puis ajouter l'image
         * nouvellement postée 
         */
        if ($this->newIllustration)
        {
            $this->message->clearMediaCollection('illustration');
            $this->message->addMedia($this->newIllustration->getRealPath())
                      ->usingName($this->newIllustration->getClientOriginalName())
                      ->toMediaCollection('illustration');
        }
        /* Mettre à jour la collection de pièces jointes : vider puis ajouter la
         * pièce jointe nouvellement postée 
         * //TODO gérer plusieurs pièces jointes
         */
        if ($this->newPiecejointe)
        {
            $this->message->clearMediaCollection('attachments');
            $this->message->addMedia($this->newPiecejointe->getRealPath())
                      ->usingName($this->newPiecejointe->getClientOriginalName())
                      ->toMediaCollection('attachments');
        }

        return redirect()->route('object', ['slug' => $this->message->slug]);
    }
    public function validateSlug()
    {
        $this->validate(['message.slug' => $this->getSlugRule()]);
    }
    public function adjustSlug()
    {
        $this->message->slug = \Util::slugify($this->message->titre);
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
    public function updatedNewPiecejointe()
    {
        $this->validate([
            'newPiecejointe' => '',
        ]);
    }
}
