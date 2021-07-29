<?php

namespace App\Http\Livewire\Message;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Rules\SlugRule;
use App\Models\Message;
use App\Models\Auteur;
use App\Models\LivreBiblique;

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
    public $auteurs;
    public $livresbibliques;

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
}
