<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
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
