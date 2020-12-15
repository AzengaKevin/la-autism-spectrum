<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Questionnaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionnaireFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Questionnaire::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'slug' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'min_age' => $this->faker->numberBetween(1, 100)
        ];
    }
}
