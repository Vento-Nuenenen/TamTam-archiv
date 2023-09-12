<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker\Factory::create();
        DB::table('participations')->insert([
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' =>  $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' =>  $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' =>  $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' =>  $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' =>  $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' =>  $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' =>  $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' =>  $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' =>  $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
            ['scout_name' => $faker->userName, 'first_name' => $faker->firstName, 'last_name' => $faker->lastName, 'address' => $faker->address, 'plz' => $faker->postcode, 'place' =>  $faker->city, 'birthday' => $faker->date(), 'gender' => 'male'],
        ]);
    }
}
