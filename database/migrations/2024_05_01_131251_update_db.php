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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('shipping_status');
            $table->dateTime('order_date');
            $table->string('shipping_state');
            $table->string('shipping_city');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('uom');
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
