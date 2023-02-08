<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MinSellingPriceToComboProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('combo_products', function (Blueprint $table) {
            $table->integer('min_selling_price')->default(0)->after('total_regular_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('combo_products', function (Blueprint $table) {
            $table->dropColumn('min_selling_price');
        });
    }
}
