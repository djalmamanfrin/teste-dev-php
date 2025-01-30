<?php

use App\Rules\CnpjCpf;
use Database\Factories\CNPJFactory;
use Database\Factories\CPFFactory;
use Illuminate\Support\Facades\Validator;

it('CNPJ validates using Laravel Validator', function () {
    $validator = Validator::make(
        ['cnpj' => CNPJFactory::valid()],
        ['cnpj' => [new CnpjCpf()]]
    );

    expect($validator->passes())->toBeTrue();
})->group('cnpj-rule');

it('CPF validates using Laravel Validator', function () {
    $validator = Validator::make(
        ['cpf' => CPFFactory::valid()],
        ['cpf' => [new CnpjCpf()]]
    );

    expect($validator->passes())->toBeTrue();
})->group('cnpj-rule');

it('fails with an invalid CNPJ using Laravel Validator', function () {
    $validator = Validator::make(
        ['cnpj' => CNPJFactory::invalid()],
        ['cnpj' => [new CnpjCpf()]]
    );

    expect($validator->fails())->toBeTrue();
})->group('cnpj-rule');

it('fails with an invalid CPF using Laravel Validator', function () {
    $validator = Validator::make(
        ['cpf' => CPFFactory::invalid()],
        ['cpf' => [new CnpjCpf()]]
    );

    expect($validator->fails())->toBeTrue();
})->group('cnpj-rule');
