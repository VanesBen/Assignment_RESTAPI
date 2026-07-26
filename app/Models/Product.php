<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function sellers() {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    public function categories() {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    protected $table = 'products';

    protected $appends = ['rating_class']; // Biar otomatis muncul di JSON response

    public function getRatingClassAttribute()
    {
        if ($this->rating >= 8.5) {
            return "Top Rated";
        } else if ($this->rating >= 7.0) {
            return "Recommended";
        }
        
        return "Regular";
    }

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
