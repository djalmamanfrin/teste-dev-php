<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CPF_CNPJ implements ValidationRule
{
    private CNPJ $cnpj;
    private CPF $cpf;

    public function __construct()
    {
        $this->cnpj = new CNPJ();
        $this->cpf = new CPF();
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $identifier = preg_replace('/\D/', '', $value);

        $isCpfOrCnpjValid = match (strlen($identifier)) {
            11 => $this->cpf->isValid($identifier),
            14 => $this->cnpj->isValid($identifier),
            default => false
        };

        if (!$isCpfOrCnpjValid) {
            $fail("O campo {$attribute} não é um CPF ou CNPJ válido.");
        }
    }
}
