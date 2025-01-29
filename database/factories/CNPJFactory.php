<?php

namespace Database\Factories;

class CNPJFactory
{
    public static function invalid(): string
    {
        $length = 14;
        return str_pad(rand(1, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
    }
    public static function valid(): string
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
}
