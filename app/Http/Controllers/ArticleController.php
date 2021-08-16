<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Auteur;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('articles.index');
    }
    public function form($id = null)
    {
        if ($id)
        {
            $article = Article::findOrFail($id);
            $titrepage = "Édition de l'article « {$article->titre} »";
        }
        else
        {
            $titrepage = "Ajout d'un nouvel article";
            $article = new Article();
            $article->initNew();
        }
        return view('articles.form', compact('titrepage', 'article'));
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\Article  $article
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $article = Article::find($id);
        $parsedown = new \Parsedown();
        $article->articleHtml = $parsedown->text($article->article);
        return view('articles.show', compact('article'));
    } 
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Article  $article
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $article = Article::find($id);
        $titre = $article->titre;
        $article->delete();
        return redirect()->route('articles.index')
            ->with('success', "L'article {$titre} a été supprimé correctement.");
    }
}
