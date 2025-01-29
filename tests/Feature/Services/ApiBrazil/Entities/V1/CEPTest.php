<?php

use App\Services\ApiBrazil\Entities\V1\CEP as CEPEntity;

test('should correctly assign data to attributes', function () {
    $data = [
        'cep' => '12345678',
        'state' => 'SP',
        'city' => 'São Paulo',
        'neighborhood' => 'Centro',
        'street' => 'Avenida Paulista',
        'service' => 'Entrega',
    ];

    $cepEntity = new CEPEntity($data);

    expect($cepEntity->cep)->toBe('12345678')
        ->and($cepEntity->state)->toBe('SP')
        ->and($cepEntity->city)->toBe('São Paulo')
        ->and($cepEntity->neighborhood)->toBe('Centro')
        ->and($cepEntity->street)->toBe('Avenida Paulista')
        ->and($cepEntity->service)->toBe('Entrega');
})->group('api_brazil');;

test('should handle missing data and assign null to attributes', function () {
    $data = [];
    $cepEntity = new CEPEntity($data);

    expect($cepEntity->cep)->toBeNull()
        ->and($cepEntity->state)->toBeNull()
        ->and($cepEntity->city)->toBeNull()
        ->and($cepEntity->neighborhood)->toBeNull()
        ->and($cepEntity->street)->toBeNull()
        ->and($cepEntity->service)->toBeNull();
})->group('api_brazil');;


