<?php

namespace App\Services\ApiBrazil\Traits;

use App\Services\ApiBrazil\Endpoints\V1\CNPJ;

trait HasCNPJ
{
    public function cnpj(): CNPJ
    {
        return new CNPJ();
    }
}
