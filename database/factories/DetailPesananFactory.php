<?php

namespace Database\Factories;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailPesananFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailPesanan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_pesanan' => Pesanan::all()->random()->id,
            'nama_lengkap' => $this->faker->name(),
            'lengan' => $this->faker->randomFloat(null, 20, 30),
            'pinggang' => $this->faker->randomFloat(null, 20, 40),
            'dada' => $this->faker->randomFloat(null, 20, 30),
            'leher' => $this->faker->randomFloat(null, 20, 30),
            'tinggi_tubuh' => $this->faker->randomFloat(null, 140, 180),
            'berat_badan' => $this->faker->randomFloat(null, 30, 70),
            'instruksi_pembuatan' => $this->faker->sentence()
        ];
    }
}
