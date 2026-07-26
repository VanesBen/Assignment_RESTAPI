<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Traits\ApiResponse;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller

{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // nanti pake with
        $transactions = Transaction::all();

        return $this->successResponse($transactions);
    }

    public function store(StoreTransactionRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                'total_amount' => $request->total_amount,
                'status' => $request->status,
                'seller_id' => $request->seller_id,
                'buyer_id' => $request->buyer_id
            ]);

            foreach ($request->items as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            DB::commit();

            return $this->createdResponse(new TransactionResource($transaction->load('details')));

        } catch (\Exception $e) {

            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }

    }


    public function show(int $id) {
        $transaction = Transaction::with('products')->find($id);

        if(!$transaction) {
            return $this->notFoundResponse("Produk tidak ditemukan");
        } else {
            return $this->successResponse($transaction, "Produk Berhasil Ditemukan");
        }
    }

}
