<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Travel>
 */
class TravelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $isValidated = $this->faker->boolean(25);
        $startedAt = $this->faker->dateTimeThisMonth;

        return [
            'vehicle_id' => $this->faker->numberBetween(1, 25),
            'driver_id' => $this->faker->numberBetween(1, 25),
            'creator_id' => 1,
            'validator_id' => $isValidated ? 2 : null,
            'validated_at' => $isValidated ? $this->faker->dateTimeThisMonth : null,
            'started_at' => $startedAt,
            'ended_at' => $startedAt->add(new \DateInterval('P3D')),
            'status' => $isValidated ? 'validated' : 'pending',
        ];
    }
}
