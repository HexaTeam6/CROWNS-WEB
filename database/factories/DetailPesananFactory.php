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
            // 'id_pesanan' => Pesanan::all()->random()->id,
            'nama_lengkap' => $this->faker->name(),
            'lengan' => $this->faker->randomFloat(null, 20.0, 30.0),
            'pinggang' => $this->faker->randomFloat(null, 20.0, 40.0),
            'dada' => $this->faker->randomFloat(null, 20.0, 30.0),
            'leher' => $this->faker->randomFloat(null, 20.0, 30.0),
            'tinggi_tubuh' => $this->faker->randomFloat(null, 140.0, 180.0),
            'berat_badan' => $this->faker->randomFloat(null, 30.0, 70.0),
            'instruksi_pembuatan' => $this->faker->sentence()
        ];
    }
}
