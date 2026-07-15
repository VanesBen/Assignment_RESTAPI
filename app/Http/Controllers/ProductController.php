<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Traits\ApiResponse;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponse;

    public function index(Request $request) {
        if ($request->has('search')) {
            return $this->search($request->query('search'));
        }

        if ($request->has('category_id')) {
            return $this->filterById($request->query('category_id'));
        }

        if ($request->has('min_price') && $request->has('max_price')) {
            return $this->filterByPrice($request->query('min_price'), $request->query('max_price'));
        }

        if ($request->has('sort_by') && $request->has('order')) {
            return $this->sortByCategory($request->query('sort_by'), $request->query('order'));
        }


        $products = Product::with(['categories', 'sellers'])->get();

        //Classification
        $products->map(function ($item) {
            $rating = $item->rating;

            if ($rating >= 8.5) {
                $item->rating_class = "Top Rated";
            } else if ($rating >= 7.0 && $rating <= 8.4) {
                $item->rating_class = "Recommended"; 
            } else if ($rating < 7.0) {
                $item->rating_class = "Regular";
            }

            return $item;

        });
        
        return $this->successResponse($products);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'seller_id' => 'required|numeric',
            'category_id' => 'required|numeric',
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
            return $this->successResponse($product, "Produk Berhasil Ditemukan");
        }
    }

    public function update(Request $request, int $id) {
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

        $product = Product::find($id);

        if(!$product) {
            return $this->notFoundResponse("Produk tidak ditemukan");
        } else {
            if ($request->user()->id !== $product->seller_id) {
                return $this->unauthorizedResponse();
            }
            $product->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'rating' => $validated['rating'],
                'category_id' => $validated['category_id'],
                'file_path' => $validated['file_path'],
                'thumbnail' => $validated['thumbnail'] ?? null, 
                'download_count' => $validated['download_count'],
                'status' => $validated['status'] ?? 'active'
            ]);
            return $this->successResponse($product, "Data berhasil di-update");
        }
    }

    public function destroy(int $id, Request $request) {
        $product = Product::find($id);

        if(!$product) {
            return $this->notFoundResponse("Produk tidak ditemukan");
        } else {

            if ($request->user()->id !== $product->seller_id) {
                return $this->unauthorizedResponse();
            }
            
            $product->delete();
            return $this->successResponse(message: "Produk Berhasil Dihapus");
        }
    }


    //search by judul
    public function search(string $title) {
        $products = Product::where('title', 'LIKE', '%'.$title.'%')->get(); 
        if($products->isEmpty()) {
            return $this->notFoundResponse("Produk tidak berhasil ditemukan");
        }
        return $this->successResponse($products, "Produk berhasil ditemukan");
    }

    //filter id
    public function filterById(int $id) {
        $products = Product::where('category_id', $id)->get(); 
        if($products->isEmpty()) {
            return $this->notFoundResponse("Produk tidak berhasil ditemukan");
        }
        return $this->successResponse($products, "Produk berhasil ditemukan");
    }

    //filter price
    public function filterByPrice(int $min_price, int $max_price) {
        $products = Product::whereBetween('price', [$min_price, $max_price])->get(); 

        if($products->isEmpty()) {
            return $this->notFoundResponse("Produk tidak berhasil ditemukan");
        }
        return $this->successResponse($products, "Produk berhasil ditemukan");
    }


    // sorting
    public function sortByCategory(string $category, string $order) {
        $products = null;
        $products = Product::orderBy($category, $order)->get(); 
        
        if(!$products || $products->isEmpty()) {
            return $this->notFoundResponse("Produk tidak berhasil ditemukan");
        }
        return $this->successResponse($products, "Produk berhasil ditemukan");
    }

    

}
