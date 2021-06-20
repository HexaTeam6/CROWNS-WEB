<?php

namespace Database\Factories;

use App\Models\LokasiPenjemputan;
use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Factories\Factory;

class LokasiPenjemputanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LokasiPenjemputan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'id_pesanan' => Pesanan::all()->random()->id,
            'kode_pos' => $this->faker->numberBetween(600000, 699999),
            'kecamatan' => $this->faker->city,
            'kota' => $this->faker->city,
            'alamat' => $this->faker->address,
            'waktu' => $this->faker->dateTime(),
            'instruksi' => $this->faker->sentence()
        ];
    }
}