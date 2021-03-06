<?php

namespace Database\Factories;

use App\Models\Penjahit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenjahitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Penjahit::class;

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
            'no_rekening' => $this->faker->bankAccountNumber,
            'bank' => $this->faker->randomElement(['BRI', 'BCA', 'BJ', 'BJB', 'BI', 'BNI']),
            'kodepos' => $this->faker->numberBetween(600000,699999),
            'kecamatan' => $this->faker->address,
            'kota' => $this->faker->city,
            'alamat' => $this->faker->address
        ];
    }
}