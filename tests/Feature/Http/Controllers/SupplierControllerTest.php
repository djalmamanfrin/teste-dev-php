<?php

use App\Models\Supplier;
use Database\Factories\CNPJFactory;
use Database\Factories\CPFFactory;
use Illuminate\Http\Response;

it('can list suppliers with pagination', function () {
    Supplier::factory()->count(10)->create();

    $response = $this->getJson('/api/suppliers');

    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => ['id', 'name', 'identifier', 'contact', 'address_id', 'created_at', 'updated_at', 'deleted_at'],
            ],
        ]);
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
    $response->assertStatus(Response::HTTP_CREATED)
        ->assertJsonFragment(['name' => 'Supplier Test']);
})->group('supplier-controller');

it('returns error when creating supplier with invalid CNPJ', function () {
    $data = [
        'name' => 'Supplier Test',
        'identifier' => CNPJFactory::invalid(),
        'contact' => '123456789',
    ];

    $response = $this->postJson('/api/suppliers', $data);
    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonPath('identifier.0', 'O campo identifier não é um CPF ou CNPJ válido.');
})->group('supplier-controller');

it('returns error when creating supplier with invalid CPF', function () {
    $data = [
        'name' => 'Supplier Test',
        'identifier' => CPFFactory::invalid(),
        'contact' => '123456789',
    ];

    $response = $this->postJson('/api/suppliers', $data);
    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
        ->assertJsonPath('identifier.0', 'O campo identifier não é um CPF ou CNPJ válido.');
})->group('supplier-controller');

it('can show supplier', function () {
    $supplier = Supplier::factory()->create();

    $response = $this->getJson('/api/suppliers/' . $supplier->id);
    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonFragment(['name' => $supplier->name]);
})->group('supplier-controller');

it('can update supplier', function () {
    $supplier = Supplier::factory()->create();
    $data = [
        'name' => 'Updated Supplier',
        'identifier' => CNPJFactory::valid(),
        'contact' => '987654321',
    ];

    $response = $this->putJson('/api/suppliers/' . $supplier->id, $data);
    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonFragment(['name' => 'Updated Supplier']);
})->group('supplier-controller');

it('can delete supplier', function () {
    $supplier = Supplier::factory()->create();

    $response = $this->deleteJson('/api/suppliers/' . $supplier->id);
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson(['message' => 'Supplier deleted successfully']);
})->group('supplier-controller');
