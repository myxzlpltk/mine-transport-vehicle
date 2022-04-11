<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1, ['email' => 'admin@gmail.com', 'role' => 'admin'])->create();
        User::factory(1, ['email' => 'validator@gmail.com', 'role' => 'validator'])->create();

        $this->call([
            DriverSeeder::class,
            VehicleSeeder::class,
            TravelSeeder::class,
        ]);
    }
}
