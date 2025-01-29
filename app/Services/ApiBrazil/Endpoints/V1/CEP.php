<?php

namespace App\Services\ApiBrazil\Endpoints\V1;

use App\Services\ApiBrazil\Endpoints\BaseEndpoints;
use App\Services\ApiBrazil\Entities\V1\CEP as CEPEntity;
use Illuminate\Support\Facades\Cache;

/**
 * BrasilApi CNPJ Documentation
 * https://brasilapi.com.br/docs#tag/CEP
 */
class CEP extends BaseEndpoints
{
    public function get(string $value): CEPEntity
    {
        return Cache::remember("cep_$value", now()->addMinutes(10), function () use ($value) {
            $response = $this->httpRequest->get("/cep/v1/$value");
            return new CEPEntity($response->json());
        });
    }
}
