<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "seller_id" => "1",
            "category_id" => "1",
            "title" => "UI KIT 1",
            "description" => "Complete UI kit for admin dashboard",
            "price" => 10000,
            "rating" => 5,
            "file_path" => "files/uikit.zip",
            "thumbnail" => null,
            "download_count" => 0,
            "status" => "active"
        ]);
        Product::create([
            "seller_id" => "1",
            "category_id" => "1",
            "title" => "UI KIT 2",
            "description" => "Complete UI kit for admin dashboard",
            "price" => 15000,
            "rating" => 6,
            "file_path" => "files/uikit.zip",
            "thumbnail" => null,
            "download_count" => 0,
            "status" => "active"
        ]);
        Product::create([
            "seller_id" => "1",
            "category_id" => "1",
            "title" => "UI KIT 3",
            "description" => "Complete UI kit for admin dashboard",
            "price" => 20000,
            "rating" => 7,
            "file_path" => "files/uikit.zip",
            "thumbnail" => null,
            "download_count" => 0,
            "status" => "active"
        ]);
    }
}
