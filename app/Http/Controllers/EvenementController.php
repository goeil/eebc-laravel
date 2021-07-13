<?php

namespace App\Http\Controllers;
use App\Models\Evenement;

use Illuminate\Http\Request;

class EvenementController extends Controller
{
    public function index()
    {
        $data['evenements'] = Evenement::orderBy('id','desc')->paginate(5);
        return view('evenements.index', $data);
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $titrepage = "Ajout d'un nouvel évènement";
        return view('evenements.form', compact('titrepage'));
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'type' => 'required',
            'horaire' => 'required'
        ]);
        $evenement = new Evenement;
        $evenement->titre = $request->titre;
        $evenement->description = $request->description;
        $evenement->type = $request->type;
        $evenement->lieu = $request->lieu;
        $evenement->organisateur = $request->organisateur;
        $evenement->horaire = $request->horaire;

        $evenement->save();

        /* Ajout de l'illustration avec MediaLibrary */
        if ($request->hasFile('illustration') 
        && $request->file('illustration')->isValid())
        {
            $evenement->addMediaFromRequest('illustration')->toMediaCollection('illustration');
        }

        return redirect()->route('evenements.index')
            ->with('success', "L'évènement {$evenement->titre} a été créé correctement.");
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\Evenement  $evenement
    * @return \Illuminate\Http\Response
    */
    public function show(Evenement $evenement)
    {
        return view('evenements.show', compact('evenement'));
    } 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Evenement  $evenement
    * @return \Illuminate\Http\Response
    */
    public function edit(Evenement $evenement)
    {
        $titrepage = "Édition de l'évènement évènement {$evenement->titre} du {$evenement->horaire}";
        return view('evenements.form', compact('evenement', 'titrepage'));
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Evenement  $evenement
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required',
            'type' => 'required',
            'horaire' => 'required'
        ]);
        $evenement = Evenement::find($id);
        $evenement->titre = $request->titre;
        $evenement->description = $request->description;
        $evenement->type = $request->type;
        $evenement->lieu = $request->lieu;
        $evenement->organisateur = $request->organisateur;
        $evenement->horaire = $request->horaire;

        /* On efface les illustrations et on les remet */
        if ($evenement) {
            if ($request->hasFile('illustration')) {
                $evenement->clearMediaCollection('illustration');
                $evenement->addMediaFromRequest('illustration')->toMediaCollection('illustration');
            }
        }
        $evenement->save();

        return redirect()->route('evenements.index')
            ->with('success', "L'évènement {$evenement->titre} a été mis à jour correctement.");
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
}
