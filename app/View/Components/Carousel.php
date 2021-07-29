<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Carousel extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $images = array();

    public function __construct()
    {
        foreach ([1, 3, 4] as $id)
        {
            $ill = \App\Models\Evenement::find($id)
                 ->getMedia('illustration')->first();
            if ($ill)
            {
                $this->images[] = $ill->getUrl('square');
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.carousel');
    }
}
