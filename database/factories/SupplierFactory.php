<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    public function definition(): array
    {
        $identifierType = $this->faker->randomElement(['cpf', 'cnpj']);
        $identifier = $identifierType === 'cpf' ? CNPJFactory::valid() : CPFFactory::valid();

        return [
            'name' => $this->faker->company,
            'identifier' => $identifier,
            'contact' => $this->faker->phoneNumber,
            'address_id' => null,
        ];
    }

    public function withAddress()
    {
        return $this->state(fn () => [
            'address_id' => Address::factory()->create()->id,
        ]);
    }
}
