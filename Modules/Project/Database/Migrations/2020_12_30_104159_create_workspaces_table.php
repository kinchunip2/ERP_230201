<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkspacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspaces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->comment('on Delete Cascade');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');

            $table->string('name', 191)->nullable();
            $table->boolean('default_workspace')->default(false);

            $table->timestamps();
        });

         DB::statement("INSERT INTO `workspaces` (`user_id`, `name`, `default_workspace`, `created_at`, `updated_at`) VALUES
        (1, 'Default Workspace', 1, now(), now())");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workspaces', function(Blueprint $table)
        {
            $table->dropForeign('workspaces_user_id_foreign');
        });
        Schema::dropIfExists('workspaces');
    }
}
