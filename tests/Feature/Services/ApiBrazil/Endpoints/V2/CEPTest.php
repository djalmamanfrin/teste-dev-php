<?php

use App\Services\ApiBrazil\Endpoints\V2\CEP;
use App\Services\ApiBrazil\Entities\V2\CEP as CEPEntity;

test('must successfully seek a CEP V2', function () {
    fakeHttpRequest( '/cep/v2/*', [
        "cep" => "89010025",
        "state" => "SC",
        "city" => "Blumenau",
        "neighborhood" => "Centro",
        "street" => "Rua Doutor Luiz de Freitas Melro",
        "service" => "viacep",
        "location" => [
            "type" => "Point",
            "coordinates" => [
                "latitude" => -23.550520,  // Latitude de São Paulo
                "longitude" => -46.633308, // Longitude de São Paulo
            ]
        ]
    ]);

    $service = new CEP();
    $cep = $service->get('89010025');
    expect($cep)->toBeInstanceOf(CEPEntity::class);
})->group('api_brazil');
