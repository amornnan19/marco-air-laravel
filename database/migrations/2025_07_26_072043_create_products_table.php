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

            // Basic Information
            $table->string('name');
            $table->string('model')->nullable();
            $table->string('brand')->nullable();
            $table->string('btu')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('image')->nullable();

            // Detailed Information
            $table->longText('description')->nullable();
            $table->json('features')->nullable();
            $table->json('specifications')->nullable();
            $table->string('category')->nullable();

            // Status & Management
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);

            $table->timestamps();

            // Indexes
            $table->index(['is_active', 'sort_order']);
            $table->index(['category', 'is_active']);
            $table->index(['brand', 'is_active']);
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
