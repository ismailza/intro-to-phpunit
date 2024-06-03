<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('images/products', 'public');
            }
            $product = Product::create($data);
            DB::commit();
            return response()->json(['message' => 'Product created successfully.', 'product'=> $product], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Product creation failed.'], 500);
        }
    }

    /**
     * Display the specified resource.
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        return response()->json(Product::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     * @param ProductRequest $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(ProductRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('images/products', 'public');
            }
            $product->update($data);
            DB::commit();
            return response()->json(['message' => 'Product updated successfully.', 'product'=> $product], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Product update failed.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            DB::commit();
            return response()->json(['message' => 'Product deleted successfully.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Product deletion failed.'], 500);
        }
    }
}
