<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCategoryResource;
use App\Http\Traits\ApiResponse;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{   
    use ApiResponse;

    public function index() {
        $product_categories = ProductCategory::all();

        return $this->successResponse($product_categories);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:product_categories,name',
            'description' => 'nullable|string',
            'icon' => 'nullable|string'
        ]);

        $product_category = ProductCategory::create($validated);

        return $this->createdResponse(new ProductCategoryResource($product_category));
        
    }


    public function show(int $id) {
        $product_category = ProductCategory::with('products')->find($id);

        if(!$product_category) {
            return $this->notFoundResponse("Produk tidak ditemukan");
        } else {
            return $this->successResponse($product_category, "Produk Berhasil Ditemukan");
        }
    }

    public function update(Request $request, int $id) {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:product_categories,name',
            'description' => 'nullable|string',
            'icon' => 'nullable|string'
        ]);

        $product_category = ProductCategory::find($id);

        if(!$product_category) {
            return $this->notFoundResponse("Produk tidak ditemukan");
        } else {
            $product_category->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'icon' => $validated['icon']
            ]);
            return $this->successResponse($product_category, "Data berhasil di-update");
        }
    }

    public function destroy(int $id) {
        $product_category = ProductCategory::find($id);

        if(!$product_category) {
            return $this->notFoundResponse("Produk tidak ditemukan");
        } else {

            if($product_category->products()->exists()) {
                return $this->errorResponse("Tidak bisa dihapus karena kategori ini memiliki produk");
            }

            $product_category->delete();
            return $this->successResponse(message: "Produk Berhasil Dihapus");
        }

        
    }



}
