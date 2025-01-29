<?php

namespace Database\Factories;

class CPFFactory
{
    public static function invalid(): string
    {
        $length = 11;
        return str_pad(rand(1, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
    }

    public static function valid(): string
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
