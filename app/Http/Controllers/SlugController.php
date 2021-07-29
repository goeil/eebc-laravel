<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SlugController extends Controller
{
    public static $classes = [
        "evenement" => [
            "model"      => \App\Models\Evenement::class,
            "controller" => '\App\Http\Controllers\EvenementController',
            "name"       => "évènement"
        ],
        "article" => [
            "model"      => \App\Models\Article::class,
            "controller" => '\App\Http\Controllers\ArticleController',
            "name"       => "article"
        ],
        "message" => [
            "model"      => \App\Models\Message::class,
            "controller" => '\App\Http\Controllers\MessageController',
            "name"       => "message"
        ],
    ];

    /**
     * Cette fonction recherche dans tous les modèles compatibles
     * un élément qui a le bon slug.
     * Sinon, elle retourne un 404 (comme c'est la dernière route de la liste, c'est
     * bien comme ça).
     */
    public function slug(string $slug)
    {
        $foundId = false;
        $controller = '';
        foreach (static::$classes as $c)
        {
            $cc = $c['model'];
            $ret = $cc::whereSlug($slug)->get();
            if (count($ret))
            {
                $foundId = $ret->first()->id;
                $controller = $c['controller'];
                $break;
            }
        }
        if ($foundId)
        {
            return app($controller)->show($foundId);
        }
        abort(404);
    }
}
