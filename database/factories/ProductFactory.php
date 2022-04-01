<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(4, true),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->numberBetween(1, 200),
            'discount' => $this->faker->numberBetween(1, 15),
            'desc' => $this->faker->text(),
            'category_id' => $this->faker->numberBetween(1, 100),
            'company_id' => $this->faker->numberBetween(1, 1000)
        ];
    }
}
