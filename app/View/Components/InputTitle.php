<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputTitle extends Component
{
    //public $titre;
    //public $slug;
    //public $prefix;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->slug();
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-title');
    }
    public function changeTitre()
    {
        dd($this);
    }
}
