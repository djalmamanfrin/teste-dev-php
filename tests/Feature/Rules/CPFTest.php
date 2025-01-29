<?php

use App\Rules\CPF;
use Database\Factories\CPFFactory;
use Illuminate\Support\Facades\Validator;

it('validates a valid CPF', function () {
    $rule = new CPF();
    expect($rule->isValid(CPFFactory::valid()))->toBeTrue();
})->group('cpf-rule');

it('invalidates an invalid CPF', function () {
    $rule = new CPF();
    expect($rule->isValid(CPFFactory::invalid()))->toBeFalse();
})->group('cpf-rule');

it('validates using Laravel Validator', function () {
    $validator = Validator::make(
        ['cpf' => CPFFactory::valid()],
        ['cpf' => [new CPF()]]
    );

    expect($validator->passes())->toBeTrue();
})->group('cpf-rule');

it('fails with an invalid CPF using Laravel Validator', function () {
    $validator = Validator::make(
        ['cpf' => CPFFactory::invalid()],
        ['cpf' => [new CPF()]]
    );

    expect($validator->fails())->toBeTrue();
})->group('cpf-rule');
