<?php

use Illuminate\Database\Seeder;

class ParticipationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        DB::table('participations')->insert([
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'FK_GRP' => 4, 'FK_EXER' => 1],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'FK_GRP' => 4, 'FK_EXER' => 2],
        ]);
    }
}
