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
        $dummyImage = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjMmI1Y2ZmIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtc2l6ZT0iMjQiIGZpbGw9IiNmZmZmZmYiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGRvbWluYW50LWJhc2VsaW5lPSJjZW50ZXIiPlVJIEtJVCBEaWdpdGFsPC90ZXh0Pjwvc3ZnPg==';

        $products = [
            [
                "title" => "UI KIT 1 - Dashboard Admin",
                "price" => 10000,
                "rating" => 5.0,
            ],
            [
                "title" => "UI KIT 2 - E-Commerce App",
                "price" => 15000,
                "rating" => 6.5,
            ],
            [
                "title" => "UI KIT 3 - Mobile Banking",
                "price" => 20000,
                "rating" => 7.0,
            ],
            [
                "title" => "UI KIT 4 - Crypto Wallet",
                "price" => 25000,
                "rating" => 8.5,
            ],
            [
                "title" => "UI KIT 5 - SaaS Platform",
                "price" => 30000,
                "rating" => 9.0,
            ],
            [
                "title" => "UI KIT 6 - Social Media App",
                "price" => 12000,
                "rating" => 6.0,
            ],
            [
                "title" => "UI KIT 7 - Healthcare Portal",
                "price" => 18000,
                "rating" => 7.5,
            ],
            [
                "title" => "UI KIT 8 - Learning Management",
                "price" => 22000,
                "rating" => 8.0,
            ],
            [
                "title" => "UI KIT 9 - Travel Booking",
                "price" => 27000,
                "rating" => 8.8,
            ],
            [
                "title" => "UI KIT 10 - Fitness Tracker",
                "price" => 35000,
                "rating" => 9.2,
            ],
            [
                "title" => "UI KIT 11 - Real Estate Web",
                "price" => 14000,
                "rating" => 6.8,
            ],
            [
                "title" => "UI KIT 12 - Food Delivery",
                "price" => 19000,
                "rating" => 7.8,
            ],
            [
                "title" => "UI KIT 13 - Job Portal Board",
                "price" => 23000,
                "rating" => 8.2,
            ],
            [
                "title" => "UI KIT 14 - Music Streaming",
                "price" => 28000,
                "rating" => 8.9,
            ],
            [
                "title" => "UI KIT 15 - Event Management",
                "price" => 32000,
                "rating" => 9.5,
            ],
            [
                "title" => "UI KIT 16 - Logistics & Tracking",
                "price" => 16000,
                "rating" => 7.1,
            ],
            [
                "title" => "UI KIT 17 - CRM System",
                "price" => 24000,
                "rating" => 8.3,
            ],
            [
                "title" => "UI KIT 18 - Smart Home IoT",
                "price" => 29000,
                "rating" => 8.7,
            ],
            [
                "title" => "UI KIT 19 - NFT Marketplace",
                "price" => 38000,
                "rating" => 9.1,
            ],
            [
                "title" => "UI KIT 20 - HR Management System",
                "price" => 42000,
                "rating" => 9.6,
            ],
        ];

        foreach ($products as $item) {
            Product::create([
                "seller_id" => "1",
                "category_id" => "1",
                "title" => $item['title'],
                "description" => "Complete modern UI kit designed for web and mobile applications with high flexibility.",
                "price" => $item['price'],
                "rating" => $item['rating'],
                "file_path" => "files/uikit.zip",
                "thumbnail" => $dummyImage,
                "download_count" => rand(0, 100),
                "status" => "active"
            ]);
        }
    }
}
