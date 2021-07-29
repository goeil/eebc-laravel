<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Auteur extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
             ->fit(\Spatie\Image\Manipulations::FIT_FILL, 100, 100);
        $this->addMediaConversion('square')
             ->fit(\Spatie\Image\Manipulations::FIT_FILL, 300, 300);
    }
    public function prenomNom()
    {
        return $this->prenom . ' ' . $this->nom;
    }
    public function abrege()
    {
        return $this->prenom[0] . '. ' . $this->nom;
    }
}
