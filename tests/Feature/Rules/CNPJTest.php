<?php

use App\Rules\CNPJ;
use Database\Factories\CNPJFactory;
use Illuminate\Support\Facades\Validator;

it('validates a valid CNPJ', function () {
    $rule = new CNPJ();
    expect($rule->isValid(CNPJFactory::valid()))->toBeTrue();
})->group('cnpj-rule');

it('invalidates an invalid CNPJ', function () {
    $rule = new CNPJ();
    expect($rule->isValid(CNPJFactory::invalid()))->toBeFalse();
})->group('cnpj-rule');

it('validates using Laravel Validator', function () {
    $validator = Validator::make(
        ['cnpj' => CNPJFactory::valid()],
        ['cnpj' => [new CNPJ()]]
    );

    expect($validator->passes())->toBeTrue();
})->group('cnpj-rule');

it('fails with an invalid CNPJ using Laravel Validator', function () {
    $validator = Validator::make(
        ['cnpj' => CNPJFactory::invalid()],
        ['cnpj' => [new CNPJ()]]
    );

    expect($validator->fails())->toBeTrue();
})->group('cnpj-rule');
