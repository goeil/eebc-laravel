<?php

namespace Database\Factories;

use App\Models\Etiquette;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtiquetteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Etiquette::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->word(),
        ];
    }
}
