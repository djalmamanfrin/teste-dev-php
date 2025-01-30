<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Supplier;
use App\Repositories\AddressRepository;
use App\Repositories\SupplierRepository;

class SupplierService
{
    protected SupplierRepository $repository;
    protected AddressRepository $addressRepository;

    public function __construct(SupplierRepository $repository, AddressRepository $addressRepository)
    {
        $this->repository = $repository;
        $this->addressRepository = $addressRepository;
    }
    public function store(array $data): Supplier
    {
        $supplier = $this->repository->create($data);
        if (!empty($data['address'])) {
            $address = $this->addressRepository->create($data['address']);
            $supplier->address()->associate($address);
            $supplier->save();
        }

        return $supplier;
    }

    public function update(Supplier $supplier, array $data): Supplier
    {
        $supplier = $this->repository->update($supplier, $data);
        if (!empty($data['address'])) {
            if (empty($supplier->address)) {
                $address = $this->addressRepository->create($data['address']);
                $supplier->address()->associate($address);
            } else {
                $supplier->address->update($data['address']);
            }
        }

        return $supplier;
    }

    public function destroy(Supplier $supplier): void
    {
        if ($supplier->address) {
            $this->addressRepository->delete($supplier->address);
        }
        $this->repository->delete($supplier);
    }
}
