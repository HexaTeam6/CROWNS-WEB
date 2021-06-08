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
            'id_user' => User::factory(),
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'no_hp' => $this->faker->phoneNumber,
            'tanggal_lahir' => $this->faker->date(),
            'no_rekening' => $this->faker->bankAccountNumber,
            'bank' => $this->faker->randomElement(['BRI', 'BCA', 'BJ', 'BJB', 'BI', 'BNI']),
            'kodepos' => $this->faker->numberBetween(100000,999999),
            'kecamatan' => $this->faker->city,
            'kota/kabupaten' => $this->faker->city,
            'alamat' => $this->faker->address,
        ];
    }
}

// $table->unsignedBigInteger('id_user');
// $table->string('nama')->nullable();
// $table->string('jenis_kelamin')->nullable();
// $table->string('no_hp')->nullable();
// $table->date('tanggal_lahir')->nullable();
// $table->string('no_rekening')->nullable();
// $table->string('bank')->nullable();
// $table->string('kodepos')->nullable();
// $table->string('kecamatan')->nullable();
// $table->string('kota/kabupaten')->nullable();
// $table->string('alamat')->nullable();