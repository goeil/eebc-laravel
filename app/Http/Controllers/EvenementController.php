<?php

namespace App\Http\Controllers;
use App\Models\Evenement;
use App\Models\LieuEvenement;
use App\Models\TypeEvenement;
use App\Models\OrganisateurEvenement;

use Illuminate\Http\Request;

class EvenementController extends Controller
{
    public function index()
    {
        $data['evenements'] = Evenement::orderBy('horaire','asc')->paginate(21);
        return view('evenements.index', $data);
    }
    public function form($id = null)
    {
        if ($id)
        {
            $evenement = Evenement::findOrFail($id);
            $t = $evenement->titre . " du " . \Date::parse($evenement->horaire)->format('d F Y');
            $titrepage = "Édition de l'évènement évènement $t";
        }
        else
        {
            $titrepage = "Ajout d'un nouvel évènement";
            $evenement = new Evenement();
            $evenement->initNew();
        }
        return view('evenements.form', compact('titrepage', 'evenement'));
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\Evenement  $evenement
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $evenement = Evenement::find($id);
        $evenement->descriptionHtml = \Util::transformMarkdown($evenement->description);
        return view('evenements.show', compact('evenement'));
    } 
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Evenement  $evenement
    * @return \Illuminate\Http\Response
    */
    public function destroy(Evenement $evenement)
    {
        $titre = $evenement->titre;
        $evenement->delete();
        return redirect()->route('evenements.index')
            ->with('success', "L'évènement {$titre} a été supprimé correctement.");
    }
    /**
    * Affiche l'agenda
    *
    * @return \Illuminate\Http\Response
    */
    public function agenda()
    {
        return view('evenements.calendrier');
    } 
}
