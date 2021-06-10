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
            ->count(20)
            ->hasPenjahit()
            ->state(['role' => 'penjahit'])
            ->create();
        User::factory()
            ->count(20)
            ->hasKonsumen()
            ->state(['role' => 'konsumen'])
            ->create();
    }
}
