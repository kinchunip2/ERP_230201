<?php

use Modules\Localization\Entities\LanguagePhrase;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagePhrasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('language_phrases', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('module_id')->nullable();
			$table->string('page_name')->nullable();
            $table->text('default_phrases')->nullable();
            $table->text('en')->nullable();
            $table->text('es')->nullable();
            $table->text('bn')->nullable();
            $table->text('fr')->nullable();
            $table->tinyInteger('status')->default('0');
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
        Schema::dropIfExists('language_phrases');
    }
}
