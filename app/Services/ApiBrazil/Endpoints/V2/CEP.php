<?php

namespace App\Services\ApiBrazil\Endpoints\V2;

use App\Services\ApiBrazil\Endpoints\BaseEndpoints;
use App\Services\ApiBrazil\Entities\V2\CEP as CEPEntity;
use Illuminate\Support\Facades\Cache;

/**
 * BrasilApi CEP V2 Documentation
 * https://brasilapi.com.br/docs#tag/CEP-V2
 */
class CEP extends BaseEndpoints
{
    public function get(string $value): CEPEntity
    {
        return Cache::remember("cep_v2_$value", now()->addMinutes(10), function () use ($value) {
            $response = $this->httpRequest->get("/cep/v2/$value");
            return new CEPEntity($response->json());
        });
    }
}
