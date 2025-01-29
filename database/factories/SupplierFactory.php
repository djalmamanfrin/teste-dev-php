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
        $identifier = $identifierType === 'cpf' ? $this->generateCNPJ() : $this->generateCPF();

        return [
            'name' => $this->faker->company,
            'identifier' => $identifier,
            'contact' => $this->faker->phoneNumber,
            'address_id' => Address::factory()->create()->id,
        ];
    }

    public function generateCNPJ(): string
    {
        $cnpj = [];
        for ($i = 0; $i < 12; $i++) {
            $cnpj[] = rand(0, 9);
        }

        $d1 = 0;
        $c = 0;
        for ($m = 5, $i = 0; $i < 12; $i++) {
            $d1 += $cnpj[$c++] * $m--;
            if ($m < 2) $m = 9;
        }
        $d1 = (10 * $d1) % 11;
        $d1 = ($d1 == 10) ? 0 : $d1;
        $cnpj[] = $d1;

        $d2 = 0;
        $c = 0;
        for ($m = 6, $i = 0; $i < 13; $i++) {
            $d2 += $cnpj[$c++] * $m--;
            if ($m < 2) $m = 9;
        }
        $d2 = (10 * $d2) % 11;
        $d2 = ($d2 == 10) ? 0 : $d2;
        $cnpj[] = $d2;

        return implode('', $cnpj);
    }

    public function generateCPF(): string
    {
        $cpf = [];
        for ($i = 0; $i < 9; $i++) {
            $cpf[] = rand(0, 9);
        }

        $d1 = 0;
        for ($c = 0; $c < 9; $c++) {
            $d1 += $cpf[$c] * (10 - $c);
        }
        $d1 = ((10 * $d1) % 11) % 10;
        $cpf[] = $d1;

        $d2 = 0;
        for ($c = 0; $c < 10; $c++) {
            $d2 += $cpf[$c] * (11 - $c);
        }
        $d2 = ((10 * $d2) % 11) % 10;
        $cpf[] = $d2;

        return implode('', $cpf);
    }
}
