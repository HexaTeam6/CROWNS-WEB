<?php

namespace Database\Factories;

use App\Models\BuktiPembayaran;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuktiPembayaranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BuktiPembayaran::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'id_pembayaran' => Pembayaran::all()->random()->id,
            'foto' => 'http://127.0.0.1:8000/storage/foto-1.jpg',
        ];
    }
}
