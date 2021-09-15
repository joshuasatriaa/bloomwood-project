<?php

namespace Database\Factories;

use App\Models\AddressArea;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressAreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AddressArea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Jakarta Utara', 'Jakarta Barat', 'Jakarta Timur', 'Jakarta Selatan']),
            'description' => 'This covers A, B, C',
            'small_price' => $this->faker->randomElement([10000, 13000, 15000]),
            'medium_price' => $this->faker->randomElement([20000, 25000, 30000])
        ];
    }
}
