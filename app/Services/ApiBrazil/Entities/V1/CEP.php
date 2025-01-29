<?php

namespace App\Services\ApiBrazil\Entities\V1;

class CEP
{
    public ?string $cep;
    public ?string $state;
    public ?string $city;
    public ?string $neighborhood;
    public ?string $street;
    public ?string $service;

    public function __construct(array $data)
    {
        $this->cep = data_get($data, 'cep');
        $this->state = data_get($data, 'state');
        $this->city = data_get($data, 'city');
        $this->neighborhood = data_get($data, 'neighborhood');
        $this->street = data_get($data, 'street');
        $this->service = data_get($data, 'service');
    }
}
