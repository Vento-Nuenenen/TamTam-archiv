<?php

namespace Database\Seeders;

use App\Models\Group;
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
        $groups_container = [
            'Migros',
            'Coop',
        ];

        foreach ($groups_container as $name) {
            $group = Group::where('name', '=', $name)->first();

            if ($group == null) {
                Group::create([
                    'name' => $name,
                ]);
            }
        }
    }
}
