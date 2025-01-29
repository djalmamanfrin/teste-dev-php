<?php

use App\Services\ApiBrazil\Endpoints\V1\CEP;
use App\Services\ApiBrazil\Entities\V1\CEP as CEPEntity;
use Illuminate\Support\Facades\Http;

test('must successfully seek a CEP', function () {
    fakeHttpRequest( '/cep/v1/*', [
        "cep" => "89010025",
        "state" => "SC",
        "city" => "Blumenau",
        "neighborhood" => "Centro",
        "street" => "Rua Doutor Luiz de Freitas Melro",
        "service" => "viacep"
    ]);

    $service = new CEP();
    $cnpj = $service->get('89010025');
    expect($cnpj)->toBeInstanceOf(CEPEntity::class);
})->group('api_brazil');
