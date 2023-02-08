<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComboProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_product_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("combo_product_id")->nullable();
            $table->unsignedBigInteger("product_qty")->nullable();
            $table->unsignedBigInteger("product_sku_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combo_product_details');
    }
}
