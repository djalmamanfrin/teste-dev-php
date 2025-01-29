<?php

namespace App\Console\Commands;

use App\Services\ApiBrazil\APIBrazilService;
use Illuminate\Console\Command;

class Playground extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'play';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Playground command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiBrazil = new APIBrazilService();
        $cnpj = $apiBrazil->cnpj()->get('19131243000197');
        $cep = $apiBrazil->cepV2()->get('89010025');
        dd($cnpj, $cep);
    }
}
