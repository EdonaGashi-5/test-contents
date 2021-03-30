<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // creates the super user
        $user = \App\Models\User::factory()->create([
            'name' => 'Super-Admin User',
            'email' => 'superadmin@example.com',
        ])->assignRole('editor');

        \App\Models\User::factory(5)->create()->each(function ($user) {
            $user->assignRole('writer');
        });

        \App\Models\User::factory(5)->create()->each(function ($user) {
            $user->assignRole('editor');
        });
    }
}
