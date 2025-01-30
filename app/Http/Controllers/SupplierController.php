<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Rules\CnpjCpf;
use App\Rules\CPF_CNPJ;
use App\Services\SupplierService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SupplierController extends Controller
{
    protected SupplierService $service;

    public function __construct(SupplierService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        $suppliers = Supplier::with('address')->paginate($perPage);

        return response()->json($suppliers);
    }

    public function store(SupplierRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $supplier = $this->service->store($data);
            return response()->json($supplier, Response::HTTP_CREATED);
        } catch (\Throwable $exception) {
            return response()->json($exception->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function show(Supplier $supplier): JsonResponse
    {
        $supplierWithAddress = $supplier->load('address');
        return response()->json($supplierWithAddress);
    }

    public function update(SupplierRequest $request, Supplier $supplier): JsonResponse
    {
        try {
            $data = $request->validated();
            $supplier = $this->service->update($supplier, $data);
            return response()->json($supplier);
        } catch (\Throwable $exception) {
            return response()->json($exception->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function destroy(Supplier $supplier): JsonResponse
    {
        $this->service->destroy($supplier);
        return response()->json(['message' => 'Supplier deleted successfully']);
    }
}
