<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key linking to users table
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Foreign key linking to products table
            $table->integer('quantity')->default(1); // Quantity of the product in the cart
            $table->decimal('price', 8, 2); // Product price at the time of adding to cart
            $table->decimal('discount_price', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
