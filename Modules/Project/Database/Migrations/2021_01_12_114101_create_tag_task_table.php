<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_task', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->nullable()->comment('on Delete Cascade');
            $table->foreign('task_id')->on('tasks')->references('id')->onDelete('cascade');

            $table->foreignId('tag_id')->nullable()->comment('on Delete Cascade');
            $table->foreign('tag_id')->on('tags')->references('id')->onDelete('cascade');
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
        Schema::table('tag_task', function(Blueprint $table)
        {
            $table->dropForeign('tag_task_task_id_foreign');
            $table->dropForeign('tag_task_tag_id_foreign');
        });
        Schema::dropIfExists('tag_task');
    }
}
