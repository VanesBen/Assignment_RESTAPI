<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Traits\ApiResponse;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;

    public function index() {
        $product = Product::all();

        return $this->successResponse($product);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255', 
            'description' => 'required|string', 
            'price' => 'required|numeric|min:0', 
            'rating' => 'required|numeric|min:0|max:10', 
            'category_id' => 'required|exists:product_categories,id', 
            'file_path' => 'required|string', 
            'thumbnail' => 'nullable|string', 
            'download_count' => 'required|numeric|min:0',
            'status' => 'in:active,inactive' 
        ]);

        $product = Product::create($validated);

        return $this->createdResponse(new ProductResource($product));
        
    }

    public function show(int $id) {
        $product = Product::findOrFail($id);

        if(!$product) {
            return $this->notFoundResponse("Produk tidak ditemukan");
        } else {
            return $this->successResponse(new ProductResource($product), "Produk Berhasil Ditemukan");
        }
    }

    public function update(Request $request, int $id) {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:product_categories,name',
            'description' => 'nullable|string',
            'icon' => 'nullable|string'
        ]);

        $product = Product::find($id);

        if(!$product) {
            return $this->notFoundResponse("Produk tidak ditemukan");
        } else {
            $product->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'icon' => $validated['icon']
            ]);
            return $this->successResponse($product, "Data berhasil di-update");
        }
    }

    public function destroy(int $id) {
        $product = Product::find($id);

        if(!$product) {
            return $this->notFoundResponse("Produk tidak ditemukan");
        } else {
            $product->delete();
            return $this->successResponse(message: "Produk Berhasil Dihapus");
        }
    }

    public function search(string $title) {
        $products = Product::where('title', 'LIKE', '%'.$title.'%')->get(); 
        if($products->isEmpty()) {
            return $this->notFoundResponse("Produk tidak berhasil ditemukan");
        }
        return $this->successResponse($products, "Produk berhasil ditemukan");
    }

    public function filterById(int $id) {
        $products = Product::where('id', $id)->get(); 
        if($products->isEmpty()) {
            return $this->notFoundResponse("Produk tidak berhasil ditemukan");
        }
        return $this->successResponse($products, "Produk berhasil ditemukan");
    }

    public function filterByPrice(int $min, int $max) {
        $products = Product::whereBetween('price', [$min, $max])->get(); 

        if($products->isEmpty()) {
            return $this->notFoundResponse("Produk tidak berhasil ditemukan");
        }
        return $this->successResponse($products, "Produk berhasil ditemukan");
    }


    // SORT
    public function sortByCategory(string $category) {
        $products = null;
        if($category == "rating") {
            $products = Product::orderBy($category, 'desc'); 
        } else if ($category == "price") {
            $products = Product::orderBy($category, 'asc'); 
        } else if ($category == "download_count") {
            $products = Product::orderBy($category, 'desc'); 
        }
        
        if($products->isEmpty()) {
            return $this->notFoundResponse("Produk tidak berhasil ditemukan");
        }
        return $this->successResponse($products, "Produk berhasil ditemukan");
    }

    //Classification

}
