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
 * Status bayar:
 * 1 -> Baru insert pembayaran kosong
 * 2 -> Penjahit sudah isi harga
 * 3 -> Pembeli sudah upload bukti bayar, tunggu di acc admin
 * 4 -> Sudah di acc, kalau ditolak balik ke 2
 * 
 * Status tawar:
 * 1 -> Pembeli bisa menawar
 * 2 -> Menunggu jawaban penjahit
 * 3 -> Tawaran diterima, kalau ditolak balik ke 1
 * 
 * 1.1.0
 * 2.1.0
 * 3.1.0  3.2.0  3.2.1  3.2.2
 * 4.2.0  4.2.1  4.2.3  (pembayaran ditolak)
 * 4.3.0  4.3.1  4.3.3  (pembayaran belum diacc)
 * 4.4.0  4.4.1  4.4.3  (sudah bayar dan masih dikerjakan)
 * 5.4.0  5.4.1  5.4.3
 * 
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
        // 1.1.0
        Pesanan::factory()
            ->count(2)
            ->state(['status_pesanan' => 1])
            ->has(Pembayaran::factory()
                    ->state($pembayaran_kosong))
            ->hasDesignKustom()
            ->create();
        
        // 2.1.0
        Pesanan::factory()
            ->count(2)
            ->state(['status_pesanan' => 2])
            ->has(Pembayaran::factory()
                    ->state($pembayaran_kosong))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->create();
        
        // 3.1.0
        Pesanan::factory()
            ->count(2)
            ->state(['status_pesanan' => 3])
            ->has(Pembayaran::factory()
                    ->state(['status_pembayaran' => 2]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->create();
        
        // //3.2.0
        // Pesanan::factory()
        //     ->count(2)
        //     ->state(['status_pesanan' => 3])
        //     ->has(Pembayaran::factory()
        //             ->state(['status_pembayaran' => 2]))
        //     ->hasDesignKustom()
        //     ->hasDetailPesanan()
        //     ->hasLokasiPenjemputan()
        //     ->create();

        // 3.2.1
        Pesanan::factory()
            ->count(2)
            ->state(['status_pesanan' => 3])
            ->has(Pembayaran::factory()
                    ->state(['status_pembayaran' => 2]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->has(Tawar::factory()->state(['status_penawaran' => 1]))
            ->create();

        // 3.2.2
        Pesanan::factory()
            ->count(2)
            ->state(['status_pesanan' => 3])
            ->has(Pembayaran::factory()
                    ->state(['status_pembayaran' => 2]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->has(Tawar::factory()->state(['status_penawaran' => 2]))
            ->create();

        // // 4.2.0
        // Pesanan::factory()
        //     ->count(2)
        //     ->state(['status_pesanan' => 4])
        //     ->has(Pembayaran::factory()
        //             ->has(BuktiPembayaran::factory())
        //             ->state(['status_pembayaran' => 2]))
        //     ->hasDesignKustom()
        //     ->hasDetailPesanan()
        //     ->hasLokasiPenjemputan()
        //     ->create();

        // 4.2.1
        Pesanan::factory()
            ->count(2)
            ->state(['status_pesanan' => 4])
            ->has(Pembayaran::factory()
                    ->has(BuktiPembayaran::factory())
                    ->state(['status_pembayaran' => 2]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->has(Tawar::factory()->state(['status_penawaran' => 1]))
            ->create();

        // 4.2.3
        Pesanan::factory()
            ->count(2)
            ->state(['status_pesanan' => 4])
            ->has(Pembayaran::factory()
                    ->has(BuktiPembayaran::factory())
                    ->state(['status_pembayaran' => 2]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->has(Tawar::factory()->state(['status_penawaran' => 3]))
            ->create();

        // // 4.3.0
        // Pesanan::factory()
        //     ->count(2)
        //     ->state(['status_pesanan' => 4])
        //     ->has(Pembayaran::factory()
        //             ->has(BuktiPembayaran::factory())
        //             ->state(['status_pembayaran' => 3]))
        //     ->hasDesignKustom()
        //     ->hasDetailPesanan()
        //     ->hasLokasiPenjemputan()
        //     ->create();

        // 4.3.1
        Pesanan::factory()
            ->count(2)
            ->state(['status_pesanan' => 4])
            ->has(Pembayaran::factory()
                    ->has(BuktiPembayaran::factory())
                    ->state(['status_pembayaran' => 3]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->has(Tawar::factory()->state(['status_penawaran' => 1]))
            ->create();

        // 4.3.3
        Pesanan::factory()
            ->count(2)
            ->state(['status_pesanan' => 4])
            ->has(Pembayaran::factory()
                    ->has(BuktiPembayaran::factory())
                    ->state(['status_pembayaran' => 3]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->has(Tawar::factory()->state(['status_penawaran' => 3]))
            ->create();

        // 4.4.0  4.4.1  4.4.3
        Pesanan::factory()
            ->count(2)
            ->state(['status_pesanan' => 4])
            ->has(Pembayaran::factory()
                    ->has(BuktiPembayaran::factory())
                    ->state(['status_pembayaran' => 4]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->create();
        
        Pesanan::factory()
            ->count(2)
            ->state(['status_pesanan' => 4])
            ->has(Pembayaran::factory()
                    ->has(BuktiPembayaran::factory())
                    ->state(['status_pembayaran' => 4]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->has(Tawar::factory()->state(['status_penawaran' => 1]))
            ->create();
        
        Pesanan::factory()
            ->count(2)
            ->state(['status_pesanan' => 4])
            ->has(Pembayaran::factory()
                    ->has(BuktiPembayaran::factory())
                    ->state(['status_pembayaran' => 4]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->has(Tawar::factory()->state(['status_penawaran' => 3]))
            ->create();

        // 5.4.0  5.4.1  5.4.3
        // Pesanan::factory()
        //     ->count(2)
        //     ->state(['status_pesanan' => 5])
        //     ->has(Pembayaran::factory()
        //             ->has(BuktiPembayaran::factory())
        //             ->state(['status_pembayaran' => 4]))
        //     ->hasDesignKustom()
        //     ->hasDetailPesanan()
        //     ->hasLokasiPenjemputan()
        //     ->create();

        Pesanan::factory()
            ->count(2)
            ->state(['status_pesanan' => 5])
            ->has(Pembayaran::factory()
                    ->has(BuktiPembayaran::factory())
                    ->state(['status_pembayaran' => 4]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->has(Tawar::factory()->state(['status_penawaran' => 1]))
            ->create();
        
        Pesanan::factory()
            ->count(2)
            ->state(['status_pesanan' => 5])
            ->has(Pembayaran::factory()
                    ->has(BuktiPembayaran::factory())
                    ->state(['status_pembayaran' => 4]))
            ->hasDesignKustom()
            ->hasDetailPesanan()
            ->hasLokasiPenjemputan()
            ->has(Tawar::factory()->state(['status_penawaran' => 3]))
            ->create();
    }
}
