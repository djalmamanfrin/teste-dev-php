<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class AddressFactory extends Factory
{
    public function definition(): array
    {
        $noNumber = $this->faker->boolean(40);
        $number = $noNumber ? $this->faker->randomNumber(3, true) : null;

        return [
            'street' => $this->faker->streetName,
            'number' => $number,
            'no_number' => $noNumber,
            'neighborhood' => $this->faker->citySuffix,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'postal_code' => $this->faker->postcode,
            'country' => $this->faker->country,
        ];
    }
}
