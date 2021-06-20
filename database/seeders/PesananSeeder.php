<?php

namespace Database\Seeders;

use App\Models\BuktiPembayaran;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Database\Seeder;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pesanan::factory()
            ->count(20)
            ->has(Pembayaran::factory()
                    ->has(BuktiPembayaran::factory()))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->hasTawar()
            ->create();
    }
}
