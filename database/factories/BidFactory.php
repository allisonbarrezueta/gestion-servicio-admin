<?php

namespace Database\Factories;

use App\Models\Bid;
use Illuminate\Database\Eloquent\Factories\Factory;

class BidFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bid::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->sentences(rand(3, 4), true),
            'offer' => $this->faker->randomFloat(2, 10, 30),
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected'])
        ];
    }
}
