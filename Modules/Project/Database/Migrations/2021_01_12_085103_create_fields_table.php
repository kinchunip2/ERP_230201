<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->comment('on Delete set null');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('set null');

            $table->foreignId('workspace_id')->nullable()->comment('on Delete Cascade');
            $table->foreign('workspace_id')->on('workspaces')->references('id')->onDelete('cascade');

            $table->string('name', 191)->nullable();
            $table->string('type', 50)->default('text');
            $table->string('format', 50)->nullable()->comment('only for type = number');
            $table->string('label', 50)->nullable()->comment('only for type = number');
            $table->string('position', 50)->nullable()->default('right')->comment('only for type = number');
            $table->string('decimal', 50)->nullable()->default(0)->comment('only for type = number');

            $table->boolean('editable')->default(false)->comment('1 => edit only creator, 0=> edit everyone');
            $table->boolean('notify')->default(false)->comment('if type = dropdown/date, 1 => notify everyone when change, 0 => not notify');

            $table->boolean('default')->default(false);
            $table->text('description')->nullable();

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
        Schema::table('fields', function(Blueprint $table)
        {
            $table->dropForeign('fields_workspace_id_foreign');
            $table->dropForeign('fields_user_id_foreign');
        });
        Schema::dropIfExists('fields');
    }
}
