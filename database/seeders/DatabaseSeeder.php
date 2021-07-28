<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory()
                    ->hasAdmin()
                    ->state([
                        'username' => 'crowns-admin',
                        'email' => 'crowns-admin-email@gmail.com',
                        'role' => 'admin',
                        'password' => bcrypt('crowns-admin-password-is-so-long'), // password
                        'remember_token' => Str::random(10)
                    ])
                    ->create();
        // $this->call(UserSeeder::class);
        // $this->call(KatalogSeeder::class);
        // $this->call(PesananSeeder::class);

    }
}
