<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_task', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_id')->nullable()->comment('on Delete Cascade');
            $table->foreign('task_id')->on('tasks')->references('id')->onDelete('cascade');

            $table->foreignId('field_id')->nullable()->comment('on Delete Cascade');
            $table->foreign('field_id')->on('fields')->references('id')->onDelete('cascade');

            $table->foreignId('user_id')->nullable()->comment('on Delete Cascade');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');

            $table->foreignId('option_id')->nullable()->comment('on Delete Cascade');
            $table->foreign('option_id')->on('field_options')->references('id')->onDelete('cascade');

            $table->timestamp('date')->nullable();
            $table->double('number', 20,6)->nullable();
            $table->longText('text')->nullable();


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
        Schema::table('field_task', function(Blueprint $table)
        {
            $table->dropForeign('field_task_task_id_foreign');
            $table->dropForeign('field_task_field_id_foreign');
        });
        Schema::dropIfExists('field_task');
    }
}
