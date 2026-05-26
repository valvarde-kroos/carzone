<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /**
     * Run the migrations.
     * Creates the products table for car parts and accessories
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Product name
            $table->string('slug')->unique(); // URL-friendly version
            $table->text('description'); // Product description
            $table->decimal('price', 10, 2); // Price with 2 decimal places
            $table->integer('stock')->default(0); // Available quantity
            $table->string('image')->nullable(); // Product image path
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Link to categories
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
