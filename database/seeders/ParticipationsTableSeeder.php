<?php

namespace Database\Seeders;

use DB;
use Faker;
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
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' => $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' => $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' => $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' => $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' => $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' => $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' => $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' => $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' => $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' => $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
        ]);
    }
}
