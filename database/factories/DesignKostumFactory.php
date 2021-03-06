<?php

namespace Database\Factories;

use App\Models\DesignKostum;
use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DesignKostumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DesignKostum::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'id_pesanan' => Pesanan::all()->random()->id,
            'foto' => asset('storage/foto-1.jpg'),
            'deskripsi' => $this->faker->sentence()
        ];
    }
}
