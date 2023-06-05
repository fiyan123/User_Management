<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Superadmin = User::create([
            'name' => 'Super Admin Aplikasi',
            'email' => 'Superadmin@gmail.com',
            'password' => bcrypt('password')
        ]);
        $Superadmin->assignRole('moderator');

        $admin = User::create([
            'name' => 'Admin Aplikasi',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('author');

        $user = User::create([
            'name' => 'User Aplikasi',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password')
        ]);
        $user->assignRole('editor');

          $ian = User::create([
            'name' => 'ian',
            'email' => 'ian@gmail.com',
            'password' => bcrypt('password')
        ]);
        $ian->assignRole(['moderator', 'author', 'editor']);
    }
}
