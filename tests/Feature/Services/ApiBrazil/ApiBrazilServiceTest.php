<?php

use App\Services\ApiBrazil\APIBrazilService;
use App\Services\ApiBrazil\Endpoints\BaseEndpoints;
use App\Services\ApiBrazil\Entities\V1\CNPJ;
use App\Services\ApiBrazil\Entities\V1\CEP;
use App\Services\ApiBrazil\Entities\V2\CEP as CEPV2;

test('should have cnpj method that returns an instance of BaseEndpoints', function () {
    $service = new APIBrazilService();

    expect(method_exists($service, 'cnpj'))->toBeTrue()
        ->and($service->cnpj())->toBeInstanceOf(BaseEndpoints::class);
})->group('api_brazil');;

test('should have cepV1 method that returns an instance of BaseEndpoints', function () {
    $service = new APIBrazilService();

    expect(method_exists($service, 'cepV1'))->toBeTrue()
        ->and($service->cepV1())->toBeInstanceOf(BaseEndpoints::class);
})->group('api_brazil');;

test('should have cepV2 method that returns an instance of BaseEndpoints', function () {
    $service = new APIBrazilService();

    expect(method_exists($service, 'cepV2'))->toBeTrue()
        ->and($service->cepV2())->toBeInstanceOf(BaseEndpoints::class);
})->group('api_brazil');



