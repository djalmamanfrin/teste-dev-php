<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CNPJ implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cnpj = preg_replace('/\D/', '', $value);

        if (!$this->isValid($cnpj)) {
            $fail("O campo {$attribute} não é um CNPJ válido.");
        }
    }

    public function isValid(string $cnpj): bool
    {
        if (strlen($cnpj) != 14 || preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        for ($t = 12; $t < 14; $t++) {
            $d = 0;
            $c = 0;

            for ($m = $t - 7, $i = $t; $i >= 1; $i--) {
                $d += $cnpj[$c++] * $m--;
                if ($m < 2) $m = 9;
            }

            $d = (10 * $d) % 11;
            $d = ($d == 10) ? 0 : $d;

            if ($cnpj[$t] != $d) {
                return false;
            }
        }

        return true;
    }
}
