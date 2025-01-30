<?php

use App\Models\Supplier;
use App\Services\SupplierService;
use Database\Factories\CNPJFactory;

beforeEach(function () {
    $this->supplierService = new SupplierService();
});

test('it can store a supplier with address', function () {
    $validCNPJ = CNPJFactory::valid();
    $data = [
        'name' => 'Supplier Test',
        'identifier' => $validCNPJ,
        'contact' => 'supplier@example.com',
        'address' => [
            'street' => 'Rua Teste',
            'number' => '123',
            'neighborhood' => 'Centro',
            'city' => 'São Paulo',
            'state' => 'SP',
            'postal_code' => '01000-000',
            'country' => 'Brasil',
        ],
    ];

    $supplier = $this->supplierService->store($data);

    expect($supplier)->toBeInstanceOf(Supplier::class)
        ->and($supplier->name)->toBe('Supplier Test')
        ->and($supplier->identifier)->toBe($validCNPJ)
        ->and($supplier->address)->not->toBeNull()
        ->and($supplier->address->street)->toBe('Rua Teste');

    $this->assertDatabaseHas('suppliers', ['id' => $supplier->id]);
    $this->assertDatabaseHas('addresses', ['id' => $supplier->address->id]);
})->group('supplier-service');

test('it can update a supplier without address', function () {
    $validCNPJ = CNPJFactory::valid();
    $supplier = Supplier::factory()->create();
    $data = [
        'name' => 'Updated Supplier',
        'identifier' => $validCNPJ,
        'contact' => 'updated@example.com',
    ];

    $updatedSupplier = $this->supplierService->update($supplier, $data);

    expect($updatedSupplier->name)->toBe('Updated Supplier')
        ->and($updatedSupplier->identifier)->toBe($validCNPJ)
        ->and($updatedSupplier->contact)->toBe('updated@example.com')
        ->and($updatedSupplier->address)->toBeNull();

    $this->assertDatabaseHas('suppliers', ['id' => $supplier->id]);
})->group('supplier-service');

test('it can delete a supplier and its address', function () {
    $supplier = Supplier::factory()->withAddress()->create();

    $this->supplierService->destroy($supplier);

    $this->assertDatabaseMissing('suppliers', ['id' => $supplier->id]);
    $this->assertDatabaseMissing('addresses', ['id' => $supplier->address->id]);
})->group('supplier-service');
