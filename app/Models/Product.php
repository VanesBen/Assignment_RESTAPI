<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'seller_id',
        'category_id',
        'title',
        'description',
        'price',
        'rating',
        'thumbnail',
        'file_path',
        'download_count',
        'status'
    ];
}
