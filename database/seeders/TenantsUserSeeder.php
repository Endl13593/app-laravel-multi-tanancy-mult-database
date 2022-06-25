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
        User::updateOrCreate(
            ['email' => 'suporte@gmail.com',],
            ['name' => 'Suporte Admin', 'password' =>  bcrypt('password')]
        );
    }
}
