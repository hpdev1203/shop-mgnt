<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountPercentToOrdersTable extends Migration
{   
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('discount_percent', 5, 2)->default(0); // Thêm cột discount_percent với giá trị mặc định là 0
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('discount_percent'); // Xóa cột discount_percent nếu cần
        });
    }
}