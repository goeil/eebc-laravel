<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Log;

class SlugRule implements Rule
{
    private $id;
    private $model;

    private $foundTitre;
    private $foundClass;
    private $slug;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id, $model)
    {
        $this->id = $id;
        $this->model = $model;
        if (!$id) $this->id = -1; // sinon la requête whereNotIn ne marche pas
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //Log::info("{$this->id}, $attribute, $value");
        $found = false;
        foreach (\App\Http\Controllers\SlugController::$classes as $c)
        {
            $ret = $c['model']::whereSlug($value)
                ->get();
            if (count($ret))
            {
                $obj = $ret->first();
                if ($obj::class == $this->model && $obj->id == $this->id)
                    // Si c'est lui-même, passer le test
                {
                    $found = false;
                }
                else
                {
                    $this->foundTitre = $obj->titre;
                    $this->foundClass = $c['name'];
                    $this->slug = $value;
                    $found = true;
                    $break;
                }
                //->whereNotIn('id', [$this->id])
            }
        }
        return !$found;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "<strong>{$this->slug}</strong> est déjà utilisé pour un autre objet.<br>" .
            "(un {$this->foundClass} nommé <i>{$this->foundTitre}</i>)";
    }
}
