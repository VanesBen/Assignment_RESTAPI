<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = "transaction_details";

    public function products() {
        return $this->hasMany(User::class, 'user_id', 'id');
    }

    public function transactions() {
        return $this->hasMany(User::class, 'transaction_id', 'id');
    }

     protected $fillable = ["transaction_id", "product_id", 'quantity', 'price'];
}
