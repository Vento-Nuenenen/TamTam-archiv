<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group')->insert([
            ['id' => '1', 'group_name' => 'Ritter Berchtold', 'FK_FLD' => null],
            ['id' => '2', 'group_name' => 'Dracheburg', 'FK_FLD' => null],
            ['id' => '3', 'group_name' => 'Virus', 'FK_FLD' => null],
            ['id' => '4', 'group_name' => 'Nünenen', 'FK_FLD' => '3'],
            ['id' => '5', 'group_name' => 'Wendelsee', 'FK_FLD' => null],
        ]);
    }
}
