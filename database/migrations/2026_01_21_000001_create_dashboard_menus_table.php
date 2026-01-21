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
        Schema::create('dashboard_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // Display name
            $table->string('key')->unique();     // Unique key (slug) for permission
            $table->string('icon')->nullable();  // FontAwesome icon class
            $table->string('route')->nullable(); // Route name
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('type')->default('dashboard'); // dashboard, link, header
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')->on('dashboard_menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_menus');
    }
};
