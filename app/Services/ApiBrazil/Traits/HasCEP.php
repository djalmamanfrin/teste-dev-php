<?php

namespace App\Services\ApiBrazil\Traits;

use App\Services\ApiBrazil\Endpoints\V1\CEP as CEPV1;
use App\Services\ApiBrazil\Endpoints\V2\CEP as CEPV2;

trait HasCEP
{
    public function cepV1(): CEPV1
    {
        return new CEPV1();
    }

    public function cepV2(): CEPV2
    {
        return new CEPV2();
    }

}
