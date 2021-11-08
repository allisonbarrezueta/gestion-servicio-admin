<?php

namespace Database\Factories;

use App\Models\Opinion;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpinionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Opinion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'request_id' => Request::inRandomOrder()->first()->id,
            'comment' => $this->faker->sentences(rand(1, 3), true),
            'rating' => $this->faker->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
