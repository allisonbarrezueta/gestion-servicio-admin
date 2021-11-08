<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->words(2, true);
        $slug = \Str::slug($name);
        $image = $this->faker->imageUrl(640, 480);

        return [
            'name' => $name,
            'slug' => $slug,
            'image' => str_replace('https://via.placeholder.com/', '', $image),
            'status' => true,
        ];
    }
}
