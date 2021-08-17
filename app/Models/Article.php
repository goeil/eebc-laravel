<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Auteur;

class Article extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    // tous les champs sont fillable avec la ligne suivante
    protected $guarded = [];

    public function initNew()
    {
        $auteur = Auteur::first();
        $this->auteur()->associate($auteur);
        $this->debutpublication = \Date::parse(now())->toDateString();
        $this->finpublication = \Date::parse(new \Date('+3 weeks'))->toDateString();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
             ->fit(\Spatie\Image\Manipulations::FIT_FILL, 100, 100);
        $this->addMediaConversion('square')
             ->fit(\Spatie\Image\Manipulations::FIT_FILL, 300, 300);
        $this->addMediaConversion('diapo')
             ->fit(\Spatie\Image\Manipulations::FIT_CONTAIN, 800, 300);
    }
    public function auteur()
    {
        return $this->belongsTo(Auteur::class);
    }

    public function etiquettes()
    {
        return $this->morphToMany(Etiquette::class, 'taggable');
    }
    public function accroche()
    {
        $parsedown = new \Parsedown();
        $html = $parsedown->text($this->description);
        return \Util::truncate_words(strip_tags($html), 15);
    }
}
