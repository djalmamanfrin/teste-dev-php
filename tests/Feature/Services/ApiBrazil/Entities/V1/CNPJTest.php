<?php

use App\Services\ApiBrazil\Entities\V1\CNPJ as CNPJEntity;

test('should correctly assign data to attributes', function () {
    $data = [
        'cnpj' => '19131243000197',
        'identificador_matriz_filial' => 1,
        'razao_social' => 'RAZÃO SOCIAL TESTE',
        'nome_fantasia' => 'NOME FANTASIA TESTE',
        'situacao_cadastral' => 2,
        'descricao_situacao_cadastral' => 'Ativa',
        'data_situacao_cadastral' => '2013-10-03',
    ];

    $cnpjEntity = new CNPJEntity($data);

    expect($cnpjEntity->value)->toBe('19131243000197')
        ->and($cnpjEntity->identificadorMatrizFilial)->toBe(1)
        ->and($cnpjEntity->razaoSocial)->toBe('RAZÃO SOCIAL TESTE')
        ->and($cnpjEntity->nomeFantasia)->toBe('NOME FANTASIA TESTE')
        ->and($cnpjEntity->situacaoCadastral)->toBe(2)
        ->and($cnpjEntity->descricaoSituacaoCadastral)->toBe('Ativa')
        ->and($cnpjEntity->dataSituacaoCadastral)->toBe('2013-10-03');
});

test('should return null for missing attributes in the input array', function () {
    $data = [];
    $cnpjEntity = new CNPJEntity($data);

    expect($cnpjEntity->value)->toBeNull()
        ->and($cnpjEntity->identificadorMatrizFilial)->toBeNull()
        ->and($cnpjEntity->razaoSocial)->toBeNull()
        ->and($cnpjEntity->nomeFantasia)->toBeNull()
        ->and($cnpjEntity->situacaoCadastral)->toBeNull()
        ->and($cnpjEntity->descricaoSituacaoCadastral)->toBeNull()
        ->and($cnpjEntity->dataSituacaoCadastral)->toBeNull();
})->group('api_brazil');;

