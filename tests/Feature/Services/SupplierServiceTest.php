<?php

use App\Models\Supplier;
use App\Repositories\AddressRepository;
use App\Repositories\SupplierRepository;
use App\Services\SupplierService;
use Database\Factories\CNPJFactory;

beforeEach(function () {
    $this->supplierRepository = Mockery::mock(SupplierRepository::class);
    $this->addressRepository = Mockery::mock(AddressRepository::class);

    $this->supplierService = new SupplierService(
        $this->supplierRepository,
        $this->addressRepository
    );
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

    $mockSupplier = Mockery::mock(\App\Models\Supplier::class);
    $mockAddress = Mockery::mock(\App\Models\Address::class);

    $this->supplierRepository
        ->shouldReceive('create')
        ->once()
        ->with(Mockery::subset($data))
        ->andReturn($mockSupplier);

    $this->addressRepository
        ->shouldReceive('create')
        ->once()
        ->with(Mockery::subset($data['address']))
        ->andReturn($mockAddress);

    $mockSupplier->shouldReceive('address')->andReturnSelf();
    $mockSupplier->shouldReceive('associate')->once()->with($mockAddress);
    $mockSupplier->shouldReceive('save')->once();

    $supplier = $this->supplierService->store($data);

    expect($supplier)->toBe($mockSupplier);

})->group('supplier-service');

test('it can update a supplier without address', function () {
    $validCNPJ = CNPJFactory::valid();
    $supplier = Mockery::mock(\App\Models\Supplier::class);
    $data = [
        'name' => 'Updated Supplier',
        'identifier' => $validCNPJ,
        'contact' => 'updated@example.com',
    ];

    $this->supplierRepository
        ->shouldReceive('update')
        ->once()
        ->with($supplier, Mockery::subset($data))
        ->andReturn($supplier);

    $supplier->shouldReceive('getAttribute')
        ->with('address')
        ->andReturnNull();

    $updatedSupplier = $this->supplierService->update($supplier, $data);

    expect($updatedSupplier)->toBe($supplier);
})->group('supplier-service');


it('can delete a supplier and its address', function () {
    $supplier = Mockery::mock(\App\Models\Supplier::class);
    $address = Mockery::mock(\App\Models\Address::class);

    $supplier->shouldReceive('getAttribute')
        ->with('address')
        ->andReturn($address);

    $this->addressRepository
        ->shouldReceive('delete')
        ->once()
        ->with($address);

    $this->supplierRepository
        ->shouldReceive('delete')
        ->once()
        ->with($supplier);

    $this->supplierService->destroy($supplier);
});

