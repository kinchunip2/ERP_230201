<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_histories', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('houseable_id');
            $table->string('houseable_type');
            $table->unsignedBigInteger('itemable_id');
            $table->string('itemable_type');
            $table->date('date')->nullable();
            $table->unsignedBigInteger('in_out');
            $table->unsignedBigInteger('product_sku_id');
            $table->boolean('status')->default(0);
            $table->unsignedBigInteger("created_by")->nullable();
            $table->foreign("created_by")->on("users")->references("id")->onDelete("cascade");
            $table->unsignedBigInteger("updated_by")->nullable();
            $table->foreign("updated_by")->on("users")->references("id")->onDelete("cascade");
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
        Schema::dropIfExists('combo_product_histories');
    }
}
