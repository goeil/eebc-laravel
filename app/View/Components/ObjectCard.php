<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Message;
use App\Models\Article;
use App\Models\Evenement;

class ObjectCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $object;
    public $class;
    public function __construct($objectId, $objectClass)
    {
        switch($objectClass)
        {
        case "App\Models\Message":
            $this->object = Message::findOrFail($objectId);
            break;
            
        case "App\Models\Evenement":
            $this->object = Evenement::findOrFail($objectId);
            break;

        case "App\Models\Article":
            $this->object = Article::findOrFail($objectId);
            break;
        }
        $this->class = $objectClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        switch($this->class)
        {
        case "App\Models\Message":
            return view('components.message-card', ['message' => $this->object]);

        case "App\Models\Evenement":
            return view('components.evenement-card', ['evenement' => $this->object]);

        case "App\Models\Article":
            return view('components.article-card', ['article' => $this->object]);
        }
                                                
    }
}

