<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->string('login_bg')->default('public/backEnd/img/login-bg.png');
            $table->string('error_page_bg')->default('public/backEnd/img/login-bg.jpg');
            $table->string('default_view')->default('normal');
        });

        \Illuminate\Support\Facades\DB::table('business_settings')->insert([
            [
                'category_type' => null,
                'type' => 'system_registration',
                'status' => '0',
                'created_at' => date('Y-m-d h:i:s')
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {

        });
    }
}
