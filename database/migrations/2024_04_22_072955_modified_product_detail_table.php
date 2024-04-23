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
        Schema::table("product_detail", function (Blueprint $table) {
            $table->dropColumn("color");
            $table->dropColumn("color_code");
            $table->dropColumn("uom");
            $table->string("title", 150);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
