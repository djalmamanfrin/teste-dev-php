<?php
/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class)->in('Unit', 'Feature');
uses(RefreshDatabase::class);
function fakeHttpRequest(string $uri, array $response): void
{
    Http::fake([config('services.api_brazil.host') . $uri => Http::response($response)]);
}
