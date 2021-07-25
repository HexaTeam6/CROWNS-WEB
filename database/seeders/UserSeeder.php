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
        User::factory()
            ->count(1)
            ->hasPenjahit()
            ->state(['role' => 'penjahit', 
                'username' => 'penjahit-username',
                'email' => 'penjahit-email@.com',
                'password' => bcrypt('penjahit-password')
            ])
            ->create();
        User::factory()
            ->count(1)
            ->hasKonsumen()
            ->state(['role' => 'pembeli',
                'username' => 'konsumen-username',
                'email' => 'konsumen-email@.com',
                'password' => bcrypt('konsumen-password')
            ])
            ->create();
    }
}
