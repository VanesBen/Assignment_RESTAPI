<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('seller_id')->constrained('users');
            $table->foreignId('category_id')->constrained('product_categories');
            $table->string('title');
            $table->text('description');
            $table->integer('price');
            $table->decimal('rating', 3,1);
            $table->string('thumbnail')->nullable();
            $table->string('file_path');
            $table->string('download_count');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
