<?php

namespace Database\Factories;

use App\Models\ContactUs;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactUsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactUs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'found_bloomwood' => $this->faker->randomElement(['google', 'facebook', 'instagram']),
            'message' => $this->faker->paragraph(25),
        ];
    }
}
