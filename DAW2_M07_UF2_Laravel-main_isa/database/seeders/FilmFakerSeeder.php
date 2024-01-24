<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB; 

class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // Informar 10 películas utilizando Faker
        for ($i = 0; $i < 10; $i++) {
            DB::table('films')->insert(array(
                'name' => $faker->sentence,
                'year' => $faker->year,
                'genre' => $faker->word,
                'country' => $faker->country,
                'duration' => $faker->numberBetween(60, 180),
                'img_url' => $faker->imageUrl(),
            ));
        }
    }
}
?>