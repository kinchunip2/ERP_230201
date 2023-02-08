<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_project', function (Blueprint $table) {
            $table->id();

            $table->foreignId('field_id')->nullable()->comment('on Delete Cascade');
            $table->foreign('field_id')->on('fields')->references('id')->onDelete('cascade');

            $table->foreignId('project_id')->nullable()->comment('on Delete Cascade');
            $table->foreign('project_id')->on('projects')->references('id')->onDelete('cascade');

            $table->unsignedSmallInteger('order')->default(0);
            $table->boolean('visibility')->default(1);

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
        Schema::table('field_project', function(Blueprint $table)
        {
            $table->dropForeign('field_project_field_id_foreign');
            $table->dropForeign('field_project_project_id_foreign');
        });
        Schema::dropIfExists('field_project');
    }
}
