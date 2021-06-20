<?php

namespace Database\Factories;

use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PembayaranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pembayaran::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'id_pesanan' =>  Pesanan::all()->random()->id,
            'biaya_jahit' => $this->faker->randomFloat(null, 20000, 1000000),
            'biaya_material' => $this->faker->randomFloat(null, 20000, 1000000),
            'biaya_kirim' => $this->faker->randomFloat(null, 0, 50000),
            'biaya_jemput' => $this->faker->randomFloat(null, 0, 50000),
            'status_pembayaran' => $this->faker->randomElement(['B', 'S']),
            'metode_pembayaran' => $this->faker->randomElement(['BANK', 'COD'])
        ];
    }
}