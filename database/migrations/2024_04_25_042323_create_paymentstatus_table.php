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
        Schema::create('payment_status', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->string('color')->nullable();
            $table->string('icon')->nullable();
            $table->integer('sort_order')->default(0);
            $table->string('is_default')->default('no');
            $table->string('is_active')->default('yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_status');
    }
};
