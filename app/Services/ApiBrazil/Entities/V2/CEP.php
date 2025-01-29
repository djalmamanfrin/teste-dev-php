<?php

namespace App\Services\ApiBrazil\Entities\V2;

use App\Services\ApiBrazil\Entities\V1\CEP as CEPV1;

class CEP extends CEPV1
{
    public array $location;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->location = data_get($data, 'location', []);
    }
}
