<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LieuEvenement extends Model
{
    use HasFactory;

    public function evenements()
    {
        return $this->hasMany(App\Model\Evenement::class);
    }
}
