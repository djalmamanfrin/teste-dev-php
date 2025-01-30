<?php

namespace App\Services;

use App\Models\Address;
use App\Models\Supplier;

class SupplierService
{
    public function store(array $data): Supplier
    {
        $supplier = Supplier::create($data);
        if (!empty($data['address'])) {
            $address = Address::create($data['address']);
            $supplier->address()->associate($address);
            $supplier->save();
        }

        return $supplier;
    }

    public function update(Supplier $supplier, array $data): Supplier
    {
        $supplier->update($data);
        if (!empty($data['address'])) {
            if (empty($supplier->address)) {
                $address = Address::create($data['address']);
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
            $supplier->address->delete();
        }
        $supplier->delete();
    }
}
