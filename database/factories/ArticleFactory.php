<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Auteur;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'titre' => $this->faker->word(),
            'soustitre' => $this->faker->word(),
            'slug' => $this->faker->unique()->slug(3),
            'article' => $this->faker->text(600),
            'debutpublication' => $this->faker->date(),
            'finpublication' => $this->faker->date(),
            'auteur_id' => Auteur::inRandomOrder()->first(),
        ];
    }
}
