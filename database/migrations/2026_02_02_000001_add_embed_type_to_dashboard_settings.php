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
        Schema::table('dashboard_settings', function (Blueprint $table) {
            $table->string('embed_type')->default('iframe')->after('src');
            $table->text('embed_code')->nullable()->after('embed_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dashboard_settings', function (Blueprint $table) {
            $table->dropColumn(['embed_type', 'embed_code']);
        });
    }
};
