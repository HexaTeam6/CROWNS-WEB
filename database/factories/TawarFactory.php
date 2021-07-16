<?php

namespace Database\Factories;

use App\Models\Pesanan;
use App\Models\Tawar;
use Illuminate\Database\Eloquent\Factories\Factory;

class TawarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tawar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'id_pesanan' => Pesanan::all()->random()->id,
            'hari_tawar' => $this->faker->date(),
            'jumlah_penawaran' => $this->faker->randomFloat(null, 1000, 50000),
            'status_penawaran' => $this->faker->randomElement([1, 2, 3]),
            'created_at' => $this->faker->dateTime()
        ];
    }
}