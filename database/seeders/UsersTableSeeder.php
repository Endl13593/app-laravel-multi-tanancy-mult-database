<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Suporte Tenants',
            'email' => 'suporte@gmail.com',
            'password' =>  bcrypt('password')
        ]);
    }
}
