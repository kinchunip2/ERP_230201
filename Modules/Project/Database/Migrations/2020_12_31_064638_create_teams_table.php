<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable();

            $table->foreignId('user_id')->nullable()->comment('on Delete Cascade');
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');

            $table->foreignId('workspace_id')->nullable()->comment('on Delete Cascade');
            $table->foreign('workspace_id')->on('workspaces')->references('id')->onDelete('cascade');

            $table->string('name', 191)->nullable();
            $table->text('description')->nullable();
            $table->integer('privacy_type')->default(false)->comment('0 => Membership by request, 1=> private, 2=> Public to organization');

            $table->timestamps();
        });

        DB::statement("INSERT INTO `teams` (`user_id`, `workspace_id`, `name`, `created_at`, `updated_at`) VALUES
        (1, 1, 'Default Team', now(), now())");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teams', function(Blueprint $table)
        {
            $table->dropForeign('teams_user_id_foreign');
            $table->dropForeign('teams_workspace_id_foreign');
        });
        Schema::dropIfExists('teams');
    }
}
