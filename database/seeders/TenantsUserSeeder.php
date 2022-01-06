<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TenantsUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Suporte Admin',
            'email' => 'suporte@gmail.com',
            'password' =>  bcrypt('password')
        ]);
    }
}
