<?php

namespace Database\Seeders;

use App\Models\User;
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
        $admin = User::create([
            'name'      => 'Admin',
            'email'     => 'admin@finance.form',
            'password'  => bcrypt('12345678'),
            'role'      => 'admin',
        ]);

        $user = User::create([
            'name'      => 'User',
            'email'     => 'user@finance.form',
            'password'  => bcrypt('12345678'),
            'role'      => 'user',
        ]);

        $spv = User::create([
            'name'      => 'supervisor',
            'email'     => 'supervisor@finance.form',
            'password'  => bcrypt('12345678'),
            'role'      => 'supervisor',
        ]);
    }
}
