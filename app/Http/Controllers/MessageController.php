<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\Auteur;
use App\Models\Etiquette;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $data['messages'] = Message::orderBy('date','desc')->paginate(20);
        return view('messages.index', $data);
    }
    public function form($id = null)
    {
        if ($id)
        {
            $message = Message::findOrFail($id);
            $t = $message->titre;
            $titrepage = "Édition du message « $t »";
        }
        else
        {
            $titrepage = "Ajout d'un nouveau message";
            $message = new Message();
            $message->initNew();
        }
        return view('messages.form', compact('titrepage', 'message'));
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\Message  $message
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $message = Message::find($id);
        $message->descriptionHtml = \Util::transformMarkdown($message->description);
        return view('messages.show', compact('message'));
    } 
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Message  $message
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $message = Message::find($id);
        $titre = $message->titre;
        $message->delete();
        return redirect()->route('messages.index')
            ->with('success', "Le message « {$titre} » a été supprimé correctement.");
    }
}

