<?php

namespace Database\Seeders;

use App\Models\Baju;
use App\Models\Kategori;
use App\Models\MemilikiKatalog;
use Illuminate\Database\Seeder;

class KatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::factory()
            ->count(5)
            ->create();
        Baju::factory()
            ->count(20)
            ->create();
        MemilikiKatalog::factory()
            ->count(50)
            ->create();
    }
}
