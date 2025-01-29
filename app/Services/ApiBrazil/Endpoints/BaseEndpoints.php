<?php

namespace App\Services\ApiBrazil\Endpoints;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

abstract class BaseEndpoints
{
    protected PendingRequest $httpRequest;

    public function __construct()
    {
        $this->httpRequest = Http::withHeaders(['Content-Type' => 'application/json'])
            ->baseUrl(config('services.api_brazil.host'));
    }

//    abstract public function get(string $value): BaseEntities;
}
