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
        Schema::create('setup', function (Blueprint $table) {
            $table->id();
            $table->boolean('step_1')->default(false);
            $table->boolean('step_2')->default(false);
            $table->boolean('step_3')->default(false);
            $table->boolean('step_4')->default(false);
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setup');
    }
};
