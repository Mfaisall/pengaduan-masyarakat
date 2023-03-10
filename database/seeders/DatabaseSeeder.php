<?php

namespace Database\Seeders;
use App\Models\User;
use FontLib\Table\Type\name;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'Admin12@gmail.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);
        

        User::create([
            'name' => 'Petugas',
            'email' => 'Petugas@gmail.com',
            'password' => bcrypt('petugas123'),
            'role' => 'petugas',
        ]);

    }
}
