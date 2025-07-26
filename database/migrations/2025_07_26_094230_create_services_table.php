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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // ชื่อบริการ
            $table->string('slug')->unique(); // air-cleaning, air-repair, air-installation
            $table->text('description'); // คำอธิบายบริการ
            $table->string('hero_image')->nullable(); // รูปหลักของบริการ
            $table->string('icon_color')->default('blue'); // สีของไอคอน
            $table->json('packages'); // แพ็กเกจบริการ (JSON)
            $table->json('details'); // รายละเอียดและเงื่อนไข (JSON)
            $table->string('contact_phone')->nullable(); // เบอร์โทรติดต่อ
            $table->integer('price_display')->nullable(); // ราคาที่แสดงในข้อมูลติดต่อ
            $table->boolean('is_active')->default(true); // สถานะเปิด/ปิดบริการ
            $table->integer('sort_order')->default(0); // ลำดับการแสดงผล
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
