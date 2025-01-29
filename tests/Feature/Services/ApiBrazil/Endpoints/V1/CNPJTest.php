<?php

use App\Services\ApiBrazil\Endpoints\V1\CNPJ;
use App\Services\ApiBrazil\Entities\V1\CNPJ as CNPJEntity;
use Illuminate\Support\Facades\Http;

test('must successfully seek a CNPJ', function () {
    fakeHttpRequest( '/cnpj/v1/*', [
        "cnpj" => "19131243000197",
        "identificador_matriz_filial" => 1,
        "razao_social" => "RAZÃO SOCIAL TESTE",
        "nome_fantasia" => "NOME FANTASIA TESTE",
        "situacao_cadastral" => 2,
        "descricao_situacao_cadastral" => "Ativa",
        "data_situacao_cadastral" => "2013-10-03",
    ]);

    $service = new CNPJ();
    $cnpj = $service->get('19131243000197');
    expect($cnpj)->toBeInstanceOf(CNPJEntity::class);
})->group('api_brazil');
