<?php

use App\Models\Supplier;
use Database\Factories\CNPJFactory;
use Database\Factories\CPFFactory;
use Database\Factories\SupplierFactory;
use Illuminate\Http\Response;

beforeEach(function () {
    // Configurações que devem ser feitas antes de cada teste, se necessário.
});

it('can list suppliers with pagination', function () {
    Supplier::factory()->count(10)->create();

    $response = $this->getJson('/api/suppliers');

    $response->assertStatus(Response::HTTP_OK);

    $response->assertJsonStructure([
        'current_page',
        'data' => [
            '*' => [
                'id',
                'name',
                'identifier',
                'contact',
                'address_id',
                'created_at',
                'updated_at',
                'deleted_at',
            ],
        ],
    ]);

    expect($response->json('current_page'))->toBe(1)
        ->and(count($response->json('data')))->toBeLessThanOrEqual(10);

    collect($response->json('data'))->each(function ($supplier) {
        expect($supplier)->toHaveKeys(['id', 'name', 'identifier', 'contact', 'address_id']);
        if (!is_null($supplier['address'])) {
            expect($supplier['address'])->toHaveKeys([
                'street', 'number', 'neighborhood', 'city',
                'state', 'postal_code', 'country'
            ]);
        }
    });
})->group('supplier-controller');

it('can create supplier', function () {

    $data = [
        'name' => 'Supplier Test',
        'identifier' => CNPJFactory::valid(),
        'contact' => '123456789',
        'address' => [
            'street' => 'Street Test',
            'number' => '123',
            'neighborhood' => 'Neighborhood Test',
            'city' => 'City Test',
            'state' => 'State Test',
            'postal_code' => '12345678',
            'country' => 'Country Test',
        ],
    ];

    $response = $this->postJson('/api/suppliers', $data);
    $response->assertStatus(Response::HTTP_CREATED);
    $response->assertJsonFragment(['name' => 'Supplier Test']);

})->group('supplier-controller');

it('can show supplier', function () {

    $supplier = Supplier::factory()->create();

    $response = $this->getJson('/api/suppliers/' . $supplier->id);
    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonFragment(['name' => $supplier->name]);
})->group('supplier-controller');

it('can update supplier', function () {

    $supplier = Supplier::factory()->create();
    $data = [
        'name' => 'Updated Supplier',
        'identifier' => CPFFactory::valid(),
        'contact' => '987654321',
        'address' => [
            'street' => 'Updated Street',
            'number' => '456',
            'neighborhood' => 'Updated Neighborhood',
            'city' => 'Updated City',
            'state' => 'Updated State',
            'postal_code' => '87654321',
            'country' => 'Updated Country',
        ],
    ];

    $response = $this->putJson('/api/suppliers/' . $supplier->id, $data);
    $response->assertStatus(Response::HTTP_OK);
    $response->assertJsonFragment(['name' => 'Updated Supplier']);
})->group('supplier-controller');

it('can delete supplier', function () {

    $supplier = Supplier::factory()->create();

    $response = $this->deleteJson('/api/suppliers/' . $supplier->id);
    $response->assertStatus(Response::HTTP_OK);
    $response->assertJson(['message' => 'Supplier deleted successfully']);
    expect(Supplier::find($supplier->id))->toBeNull();
})->group('supplier-controller');
