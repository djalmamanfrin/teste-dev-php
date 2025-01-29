<?php

namespace App\Services\ApiBrazil;

use App\Services\ApiBrazil\Traits\HasCEP;
use App\Services\ApiBrazil\Traits\HasCNPJ;

class APIBrazilService
{
    use HasCNPJ, HasCEP;
}
