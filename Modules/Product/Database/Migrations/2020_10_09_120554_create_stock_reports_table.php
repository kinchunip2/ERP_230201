<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockReportsTable extends Migration
{

    public function up()
    {
        Schema::create('stock_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('houseable_id');
            $table->string('houseable_type');
            $table->date('stock_date');
            $table->unsignedBigInteger('product_sku_id');
            $table->string('stock')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_reports');
    }
}
