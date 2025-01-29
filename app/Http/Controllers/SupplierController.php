<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Supplier;
use App\Rules\CPF_CNPJ;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $suppliers = Supplier::with('address')->paginate($perPage);

        return response()->json($suppliers);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate($this->rules());
        $supplier = Supplier::create($validatedData);
        if (!empty($validatedData['address'])) {
            $address = Address::create($validatedData['address']);
            $supplier->address()->associate($address);
            $supplier->save();
        }

        return response()->json($supplier, Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        $supplier = Supplier::with('address')->findOrFail($id);
        return response()->json($supplier);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate($this->rules($id));
        $supplier = Supplier::findOrFail($id);
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

    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        if ($supplier->address) {
            $supplier->address->delete();
        }
        $supplier->delete();

        return response()->json(['message' => 'Supplier deleted successfully']);
    }

    private function rules($id = null): array
    {
        return [
            'name' => 'required|string|max:255',
            'identifier' => [
                'required',
                'string',
                'max:255',
                Rule::unique('suppliers', 'identifier')->ignore($id),
                new CPF_CNPJ(),
            ],
            'contact' => 'required|string|max:255',
            'address.street' => 'nullable|string|max:255',
            'address.number' => 'nullable|string|max:255',
            'address.neighborhood' => 'nullable|string|max:255',
            'address.city' => 'nullable|string|max:255',
            'address.state' => 'nullable|string|max:255',
            'address.postal_code' => 'nullable|string|max:255',
            'address.country' => 'nullable|string|max:255',
        ];
    }
}
