<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed test admin
        $seededAdminEmail = 'admin@tab.ch';
        $user = User::where('email', '=', $seededAdminEmail)->first();
        if ($user === null) {
            $user = User::create(['scout_name' => 'Admin', 'first_name' => 'Admin', 'last_name' => 'Admin', 'email' => $seededAdminEmail, 'password' => Hash::make('password')]);
            $user->save();
        }

        // Seed test user
        $user = User::where('email', '=', 'user@user.com')->first();
        if ($user === null) {
            $user = User::create([
                'scout_name'                     => 'Vento',
                'first_name'                     => 'Caspar',
                'last_name'                      => 'Brenneisen',
                'email'                          => 'caspar.brenneisen@protonmail.ch',
                'password'                       => Hash::make('password'),
            ]);
            $user->save();
        }
    }
}
