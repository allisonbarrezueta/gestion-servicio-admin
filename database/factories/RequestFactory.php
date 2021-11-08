<?php

namespace Database\Factories;

use App\Models\Request;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Request::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date(),
            'address' => $this->faker->address(),
            'description' => $this->faker->sentences(rand(1, 3), true),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed', 'failed']),
        ];
    }
}
