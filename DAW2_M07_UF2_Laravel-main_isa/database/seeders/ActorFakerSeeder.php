<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ActorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // Informar 10 actores utilizando Faker
        for ($i = 0; $i < 10; $i++) {
            DB::table('actors')->insert(array(
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'birthdate' => $faker->date('Y-m-d'),
                'country' => $faker->country,
                'img_url' => $faker->imageUrl(),
                'created_at' => now(),
                'updated_at' => now(),
            ));
        }
    }
}
