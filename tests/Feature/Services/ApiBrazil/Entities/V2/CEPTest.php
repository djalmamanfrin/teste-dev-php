<?php

use App\Services\ApiBrazil\Entities\V2\CEP as CEPEntity;

test('should inherit attributes from V1 and assign location correctly', function () {
    $data = [
        'cep' => '12345678',
        'state' => 'SP',
        'city' => 'São Paulo',
        'neighborhood' => 'Centro',
        'street' => 'Avenida Paulista',
        'service' => 'Entrega',
        'location' => [
            'latitude' => -23.550520,
            'longitude' => -46.633308,
        ],
    ];

    $cepEntityV2 = new CEPEntity($data);

    // Check attributes inherited from version 1
    expect($cepEntityV2->cep)->toBe('12345678')
        ->and($cepEntityV2->state)->toBe('SP')
        ->and($cepEntityV2->city)->toBe('São Paulo')
        ->and($cepEntityV2->neighborhood)->toBe('Centro')
        ->and($cepEntityV2->street)->toBe('Avenida Paulista')
        ->and($cepEntityV2->service)->toBe('Entrega')
        ->and($cepEntityV2->location)->toBeArray()
        ->and($cepEntityV2->location['latitude'])->toBe(-23.550520)
        ->and($cepEntityV2->location['longitude'])->toBe(-46.633308);
});

test('should assign location attribute correctly', function () {
    $data = [
        'cep' => '12345678',
        'state' => 'SP',
        'city' => 'São Paulo',
        'neighborhood' => 'Centro',
        'street' => 'Avenida Paulista',
        'service' => 'Entrega',
        'location' => [
            'latitude' => -23.550520,
            'longitude' => -46.633308,
        ],
    ];

    $cepEntityV2 = new CEPEntity($data);

    expect($cepEntityV2->location)->toBe([
        'latitude' => -23.550520,
        'longitude' => -46.633308,
    ]);
})->group('api_brazil');;

test('should handle missing location and assign empty array', function () {
    $data = [
        'cep' => '12345678',
        'state' => 'SP',
        'city' => 'São Paulo',
        'neighborhood' => 'Centro',
        'street' => 'Avenida Paulista',
        'service' => 'Entrega',
        // missing location
    ];

    $cepEntityV2 = new CEPEntity($data);

    expect($cepEntityV2->location)->toBeArray()
        ->and($cepEntityV2->location)->toBeEmpty();
})->group('api_brazil');;

