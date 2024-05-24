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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('Type');
            $table->integer('Price');
            $table->string('Size');
            $table->string('Description');
            $table->integer('stock');
            $table->unsignedBigInteger('category_id'); // Ensure it's unsigned
            $table->foreign('category_id')->references('id')->on('categories');
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
