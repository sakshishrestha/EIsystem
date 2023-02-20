<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Income;
use App\Models\User;

class IncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $models = Income::class;
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'salary' => $this->faker->randomNumber(5,true),
            'date' => $this->faker->date(),
        ];
    }
}
