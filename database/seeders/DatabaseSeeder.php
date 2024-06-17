<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            User::factory()->create([
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'address' => $faker->address,
                'postalcode' => $faker->postcode,
                'city' => $faker->city,
                'phone' => $faker->phoneNumber,
                'role' => 'agriculteur',
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'remember_token' => Str::random(10),
            ]);
        }
        $this->call([
            CategorySeeder::class,
        ]);
        $this->call([
            ProductSeeder::class,
        ]);
    }
}
