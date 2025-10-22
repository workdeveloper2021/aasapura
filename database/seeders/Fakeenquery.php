<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Enquiries;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class Fakeenquery extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            Enquiries::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->numerify('##########'),
                'subject' => $faker->sentence,
                'message' => $faker->sentence,
            ]);
        }

    }
}