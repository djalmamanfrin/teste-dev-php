<?php

namespace App\Services\ApiBrazil\Entities\V1;

class CNPJ
{
    public ?string $value;
    public ?int $identificadorMatrizFilial;
    public ?string $razaoSocial;
    public ?string $nomeFantasia;
    public ?int $situacaoCadastral;
    public ?string $descricaoSituacaoCadastral;
    public ?string $dataSituacaoCadastral;

    public function __construct(array $data)
    {
        $this->value = data_get($data, 'cnpj');
        $this->identificadorMatrizFilial = data_get($data, 'identificador_matriz_filial');
        $this->razaoSocial = data_get($data, 'razao_social');
        $this->nomeFantasia = data_get($data, 'nome_fantasia');
        $this->situacaoCadastral = data_get($data, 'situacao_cadastral');
        $this->descricaoSituacaoCadastral = data_get($data, 'descricao_situacao_cadastral');
        $this->dataSituacaoCadastral = data_get($data, 'data_situacao_cadastral');
    }
}
