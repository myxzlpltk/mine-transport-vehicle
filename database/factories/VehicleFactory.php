<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\Fakecar($this->faker));

        return [
            'type' => 'truck',
            'model'=> $this->faker->vehicleModel,
            'brand' => $this->faker->vehicleBrand,
            'color' => $this->faker->colorName,
            'year' => $this->faker->year,
            'plate' => $this->faker->vehicleRegistration,
        ];
    }
}
