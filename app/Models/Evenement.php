<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\LieuEvenement;
use App\Models\TypeEvenement;
use App\Models\OrganisateurEvenement;

class Evenement extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    // tous les champs sont fillable avec la ligne suivante
    protected $guarded = [];
    //protected $dates = ['horaire'];

    public function initNew()
    {
        $lieu = LieuEvenement::firstWhere('nom', 'La Chapelle');
        $organisateur = OrganisateurEvenement::firstWhere('nom', 'EEBC');
        $type = TypeEvenement::firstWhere('nom', 'Culte');
        $this->lieu()->associate($lieu);
        $this->type()->associate($type);
        $this->organisateur()->associate($organisateur);
        //$this->horaire = Date::parse(now())->format('d F Y à H:i');
        $this->horaire = \Date::parse(now())->toDateTimeString();
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

    public function organisateur()
    {
        return $this->belongsTo(OrganisateurEvenement::class);
    }
    public function lieu()
    {
        return $this->belongsTo(LieuEvenement::class);
    }
    public function type()
    {
        return $this->belongsTo(TypeEvenement::class);
    }
    public function etiquettes()
    {
        return $this->morphToMany(Etiquette::class, 'taggable');
    }
    public function horaireHumain()
    {
        $h = \Date::parse($this->horaire);
        $diff = $h->diffInDays(now(), false);
        if ($diff == 0)
        {
            return "Aujourd'hui";
        }
        else if ($diff > -7 && $diff < 0)
        {
            return $h->format('l');
        }
        else if ($diff <= -7)
        {
            return $h->format('d F');
        }
        else
        {
            return "dans le passé";
        }
    } 
}
