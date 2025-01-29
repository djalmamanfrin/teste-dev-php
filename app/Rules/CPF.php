<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CPF implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cpf = preg_replace('/\D/', '', $value);

        if (!$this->isValid($cpf)) {
            $fail("O campo {$attribute} não é um CPF válido.");
        }
    }

    public function isValid(string $cpf): bool
    {
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$t] != $d) {
                return false;
            }
        }

        return true;
    }
}
