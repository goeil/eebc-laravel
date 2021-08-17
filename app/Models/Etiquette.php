<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use App\Models\Message;
use App\Models\Evenement;

class Etiquette extends Model
{
    use HasFactory;

    // tous les champs sont fillable avec la ligne suivante
    protected $guarded = [];

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }
    public function messages()
    {
        return $this->morphedByMany(Message::class, 'taggable');
    }
    public function evenements()
    {
        return $this->morphedByMany(Evenement::class, 'taggable');
    }
    public function nomUrl()
    {
        return \Util::sansAccent($this->nom);
    }
}
