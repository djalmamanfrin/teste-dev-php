<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CnpjCpf implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $identifier = preg_replace('/\D/', '', $value);

        $isCpfOrCnpjValid = match (strlen($identifier)) {
            11 => $this->isCpfValid($identifier),
            14 => $this->isCnpjValid($identifier),
            default => false
        };

        if (!$isCpfOrCnpjValid) {
            $fail("O campo {$attribute} não é um CPF ou CNPJ válido.");
        }
    }

    private function isCnpjValid(string $cnpj): bool
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

    private function isCpfValid(string $cpf): bool
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
