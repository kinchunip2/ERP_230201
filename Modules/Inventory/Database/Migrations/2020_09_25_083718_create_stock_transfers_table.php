<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sendable_id');
            $table->string('sendable_type');
            $table->unsignedBigInteger('receivable_id');
            $table->string('receivable_type');
            $table->date('date');
            $table->boolean('status')->default(false);
            $table->date('sent_at')->nullable();
            $table->date('received_at')->nullable();
            $table->longText('documents')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('stock_transfers');
    }
}
