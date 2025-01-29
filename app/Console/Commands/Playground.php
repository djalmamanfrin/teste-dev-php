<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

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
        $data = Http::get('https://brasilapi.com.br/api/cnpj/v1/19131243000197');
        $json = $data->json();
        dd($json);
    }
}
