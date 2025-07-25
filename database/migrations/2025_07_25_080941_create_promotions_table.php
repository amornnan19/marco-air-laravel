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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('image_path')->nullable();
            $table->string('link_url')->nullable();
            $table->string('button_text')->default('ดูรายละเอียด');
            $table->boolean('is_active')->default(true);
            $table->datetime('start_date')->nullable();
            $table->datetime('end_date')->nullable();
            $table->integer('sort_order')->default(0);
            $table->string('background_color')->default('#3B82F6');
            $table->timestamps();

            $table->index(['is_active', 'start_date', 'end_date']);
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
