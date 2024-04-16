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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->foreign('cart_id')->references('id')->on('cart');
            $table->string('shipping_address');
            $table->string('shipping_phone', 20);
            $table->string('shipping_email');
            $table->string('shipping_method');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->string('shipping_status');
            $table->string('status');
            $table->decimal('subtotal_amount', 15, 2);
            $table->decimal('tax_amount', 15, 2);
            $table->decimal('shipping_amount', 15, 2);
            $table->decimal('discount_amount', 15, 2);
            $table->decimal('grandtotal_amount', 15, 2);
            $table->decimal('total_amount', 15, 2);
            $table->string('note')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
