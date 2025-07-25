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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('terms_accepted')->default(false)->after('phone');
            $table->timestamp('terms_accepted_at')->nullable()->after('terms_accepted');
            $table->boolean('marketing_consent')->default(false)->after('terms_accepted_at');
            $table->boolean('data_sharing_consent')->default(false)->after('marketing_consent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['terms_accepted', 'terms_accepted_at', 'marketing_consent', 'data_sharing_consent']);
        });
    }
};
