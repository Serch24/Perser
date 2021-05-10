<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->title(),
            'price' => $this->faker->numberBetween(100,100000),
            'description' => $this->faker->paragraph(5),
            'image' => $this->faker->imageUrl(640,480,'cats'),
        ];
    }
}
