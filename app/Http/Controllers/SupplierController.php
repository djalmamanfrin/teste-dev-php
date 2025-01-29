<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Address;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SupplierController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        $suppliers = Supplier::with('address')->paginate($perPage);

        return response()->json($suppliers);
    }

    public function store(SupplierRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $supplier = Supplier::create($validatedData);
        if (!empty($validatedData['address'])) {
            $address = Address::create($validatedData['address']);
            $supplier->address()->associate($address);
            $supplier->save();
        }

        return response()->json($supplier, Response::HTTP_CREATED);
    }

    public function show(Supplier $supplier): JsonResponse
    {
        $supplierWithAddress = $supplier->load('address');
        return response()->json($supplierWithAddress);
    }

    public function update(SupplierRequest $request, Supplier $supplier): JsonResponse
    {
        $validatedData = $request->validated();
        $supplier->update($validatedData);

        if (!empty($validatedData['address'])) {
            if (empty($supplier->address)) {
                $address = Address::create($validatedData['address']);
                $supplier->address()->associate($address);
            } else {
                $supplier->address->update($validatedData['address']);
            }
        }

        return response()->json($supplier);
    }

    public function destroy(Supplier $supplier): JsonResponse
    {
        if ($supplier->address) {
            $supplier->address->delete();
        }
        $supplier->delete();

        return response()->json(['message' => 'Supplier deleted successfully']);
    }
}
