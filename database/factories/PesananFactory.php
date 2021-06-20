<?php

namespace Database\Factories;

use App\Models\Baju;
use App\Models\Konsumen;
use App\Models\Penjahit;
use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PesananFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pesanan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_penjahit' => Penjahit::all()->random()->id,
            'id_konsumen' => Konsumen::all()->random()->id,
            'id_baju' => Baju::all()->random()->id,
            'jumlah' => $this->faker->numberBetween(1, 40),
            'biaya_total' => $this->faker->randomFloat(null, 30000, 1000000),
            'status_pesanan' => $this->faker->randomElement(['B', 'S'])
        ];
    }
}