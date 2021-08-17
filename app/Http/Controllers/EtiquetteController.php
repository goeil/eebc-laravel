<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etiquette;

class EtiquetteController extends Controller
{
    public function liste($tag)
    {
        $etiquette = Etiquette::where('nom', $tag)->first();
        $objects = array();
        $messages = $etiquette->messages()->get();
        foreach($messages as $m)
        {
            $objects[] = $m;
        }
        $articles = $etiquette->articles()->get();
        foreach($articles as $m)
        {
            $objects[] = $m;
        }
        $evenements = $etiquette->evenements()->get();
        foreach($evenements as $m)
        {
            $objects[] = $m;
        }
        return view('etiquette', compact('etiquette', 'objects'));
    } 
}
