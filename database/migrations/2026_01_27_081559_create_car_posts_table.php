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
        Schema::create('car_posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_title');
            $table->text('post_description');
            $table->string('image');
            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('categoriess')->onDelete('cascade');

             $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_posts');
    }
};
