<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Expense;
use App\Models\User;

class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Expense::class;
    
    public function definition()
    {
        return [
        //    'user_id' => rand(1,40),
           'user_id' => User::all()->random()->id,
           'items' => $this->faker->word(),
           'price' => $this->faker->randomNumber(5, false),
           'date' => $this->faker->date()
        ];
    }
}
