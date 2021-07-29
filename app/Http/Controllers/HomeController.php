<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Message;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        $messages = [
            ['date' => '7 juillet 2021',
            'youtube' => 'https://www.youtube.com/watch?v=Wqu-d_b3K-0',
            'slug' => 'titi',
            'titre' => 'Tous unis en Jésus-Christ'],
            ['date' => '7 juillet 2021',
            'youtube' => 'https://www.youtube.com/watch?v=Wqu-d_b3K-0',
            'slug' => 'titi',
            'titre' => 'Tous unis en Jésus-Christ'],
            ['date' => '7 juillet 2021',
            'youtube' => 'https://www.youtube.com/watch?v=Wqu-d_b3K-0',
            'slug' => 'titi',
            'titre' => 'Tous unis en Jésus-Christ'],
        ];
        $evenements = Evenement::whereDate('horaire', '>', \Date::today())->orderBy('horaire','desc')->limit(5)->get();
        $messages = Message::whereDate('date', '<', \Date::today())->orderBy('date','desc')->limit(3)->get()->reverse();
        return view('welcome', compact('evenements', 'messages'));
    }
}
