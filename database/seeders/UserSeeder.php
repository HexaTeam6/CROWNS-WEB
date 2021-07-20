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
                'password' => 'penjahit-password'
            ])
            ->create();
        User::factory()
            ->count(1)
            ->hasKonsumen()
            ->state(['role' => 'konsumen',
                'username' => 'konsumen-username',
                'email' => 'konsumen-email@.com',
                'password' => 'konsumen-password'
            ])
            ->create();
    }
}
