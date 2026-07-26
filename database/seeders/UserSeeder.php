<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ben',
            'email' => 'ben@gmail.com',
            'role' => 'seller',
            'balance' => '100',
            'password' => Hash::make('ben123')
        ]);
        
        User::create([
            'name' => 'julio',
            'email' => 'julio@gmail.com',
            'role' => 'admin',
            'balance' => '100',
            'password' => Hash::make('admin123')
        ]);
        
        User::create([
            'name' => 'julius',
            'email' => 'julius@gmail.com',
            'role' => 'buyer',
            'balance' => '100',
            'password' => Hash::make('julius123')
        ]);
    }
}
