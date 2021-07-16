<?php

namespace Database\Seeders;

use App\Models\BuktiPembayaran;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use App\Models\Tawar;
use Illuminate\Database\Seeder;

/**
 * Status pesanan:
 * 1 -> Baru insert pesanan kosong
 * 2 -> Sudah isi detail
 * 3 -> Sudah isi lokasi penjemputan
 * 4 -> Sudah upload bukti bayar
 * 5 -> Pesanan selesai
 * 
 * Status tawar:
 * 1 -> Pembeli bisa menawar
 * 2 -> Menunggu jawaban penjahit
 * 3 -> Tawaran diterima, kalau ditolak balik ke 1
 * 
 * Status bayar:
 * 1 -> Baru insert pembayaran kosong
 * 2 -> Penjahit sudah isi harga
 * 3 -> Pembeli sudah upload bukti bayar, tunggu di acc admin
 * 4 -> Sudah di acc, kalau ditolak balik ke 2
 */

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pembayaran_kosong = [
            'biaya_jahit' => 0,
            'biaya_material' => 0,
            'biaya_kirim' => 0,
            'biaya_jemput' => 0,
            'status_pembayaran' => 1,
            'metode_pembayaran' => ''
        ];
        // 1:pesanan
        Pesanan::factory()
            ->count(10)
            ->has(Pembayaran::factory()
                    ->state($pembayaran_kosong))
            ->hasDesignKustom()
            ->state(['status_pesanan' => 1])
            ->create();
        
        // 2:pesanan
        Pesanan::factory()
            ->count(10)
            ->has(Pembayaran::factory()
                    ->state($pembayaran_kosong))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->state(['status_pesanan' => 2])
            ->create();
        
        // 3:pesanan && (1/2:bayar)
        Pesanan::factory()
            ->count(10)
            ->has(Pembayaran::factory()
                    ->state($pembayaran_kosong))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->state(['status_pesanan' => 3])
            ->create();
        Pesanan::factory()
            ->count(10)
            ->has(Pembayaran::factory()
                    ->state(['status_pembayaran' => 2]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->state(['status_pesanan' => 3])
            ->create();

        // 4:pesanan && 3:bayar && (1/2/3:tawar)
        Pesanan::factory()
            ->count(10)
            ->has(Pembayaran::factory()
                    ->has(BuktiPembayaran::factory())
                    ->state(['status_pembayaran' => 3]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->has(Tawar::factory()->state(['status_penawaran' => 1]))
            ->state(['status_pesanan' => 4])
            ->create();
        Pesanan::factory()
            ->count(10)
            ->has(Pembayaran::factory()
                    ->has(BuktiPembayaran::factory())
                    ->state(['status_pembayaran' => 3]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->has(Tawar::factory()->state(['status_penawaran' => 2]))
            ->state(['status_pesanan' => 4])
            ->create();
        Pesanan::factory()
            ->count(10)
            ->has(Pembayaran::factory()
                    ->has(BuktiPembayaran::factory())
                    ->state(['status_pembayaran' => 3]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->has(Tawar::factory()->state(['status_penawaran' => 3]))
            ->state(['status_pesanan' => 4])
            ->create();

        // 5:pesanan
        Pesanan::factory()
            ->count(20)
            ->has(Pembayaran::factory()
                    ->has(BuktiPembayaran::factory())
                    ->state(['status_pembayaran' => 3]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->hasTawar()
            ->state(['status_pesanan' => 5])
            ->create();
    }
}
