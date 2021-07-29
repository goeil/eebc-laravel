<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\Auteur;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titre' => $this->faker->word(),
            'slug' => $this->faker->unique()->word(),
            'description' => $this->faker->text(400),
            'date' => $this->faker->date(),
            'auteur_id' => Auteur::inRandomOrder()->first(),
            'duree' => $this->faker->randomNumber(2, false),
            'lien' => "https://www.youtube.com/watch?v=kGT73GcwhCU",
        ];
    }
}
