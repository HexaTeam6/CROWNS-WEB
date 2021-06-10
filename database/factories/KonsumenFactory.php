<?php

namespace Database\Factories;

use App\Models\Konsumen;
use Illuminate\Database\Eloquent\Factories\Factory;

class KonsumenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Konsumen::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'id_user' => User::factory(),
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'no_hp' => $this->faker->phoneNumber,
            'tanggal_lahir' => $this->faker->date(),
            'kodepos' => $this->faker->numberBetween(600000,699999),
            'kecamatan' => $this->faker->city,
            'kota' => $this->faker->city,
            'alamat' => $this->faker->address
        ];
    }
}