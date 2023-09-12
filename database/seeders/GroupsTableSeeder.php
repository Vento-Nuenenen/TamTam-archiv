<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('groups')->insert([
            ['id' => '1', 'group_name' => 'Migros'],
            ['id' => '2', 'group_name' => 'Coop'],
        ]);
    }
}
