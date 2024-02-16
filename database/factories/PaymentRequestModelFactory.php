<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentRequestModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_date'      => $this->faker->dateTime(),
            'received_date'     => $this->faker->dateTime(),
            'date_pr'           => $this->faker->dateTimeThisMonth(),
            'for'               => $this->faker->company(),
            'contract'          => $this->faker->randomAscii(),
            'currency'          => 'idrtoidr',
            'bank_charge'       => 1,
        ];
    }
}
