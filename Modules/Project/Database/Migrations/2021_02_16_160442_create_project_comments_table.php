<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_comments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')->nullable();
            $table->foreign('project_id')->on('projects')->references('id')->onDelete('cascade');

            $table->foreignId('parent_id')->nullable();
            $table->foreign('parent_id')->on('project_comments')->references('id')->onDelete('cascade');

            $table->foreignId('created_by')->nullable();
            $table->foreign('created_by')->on('users')->references('id')->onDelete('cascade');

            $table->longText('comment')->nullable();

            $table->boolean('pin_top')->default(0);
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
        Schema::dropIfExists('project_comments');
    }
}
