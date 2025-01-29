<?php

namespace App\Services\ApiBrazil\Endpoints\V1;

use App\Services\ApiBrazil\Endpoints\BaseEndpoints;
use App\Services\ApiBrazil\Entities\V1\CEP as CEPEntity;
use App\Services\ApiBrazil\Entities\V1\CNPJ as CNPJEntity;
use Illuminate\Support\Facades\Cache;

/**
 * BrasilApi CNPJ Documentation
 * https://brasilapi.com.br/docs#tag/CNPJ
 */
class CNPJ extends BaseEndpoints
{
    public function get(string $value): CNPJEntity
    {
        return Cache::remember("cnpj_$value", now()->addMinutes(10), function () use ($value) {
            $response = $this->httpRequest->get("/cnpj/v1/$value");
            return new CNPJEntity($response->json());
        });
    }
}
