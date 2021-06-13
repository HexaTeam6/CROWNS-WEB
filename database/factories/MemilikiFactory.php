<?php

namespace Database\Factories;

use App\Models\Baju;
use App\Models\Model;
use App\Models\Penjahit;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemilikiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_penjahit' => Penjahit::all()->random()->id,
            'id_baju' => Baju::all()->random()->id
        ];
    }
}
