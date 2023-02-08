
<?php

use Modules\Localization\Entities\SelectedLanguage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectedLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selected_languages', function (Blueprint $table) {
            $table->id();
            $table->string('language_name')->nullable();
            $table->string('native')->nullable();
            $table->unsignedBigInteger('lang_id')->nullable();
            $table->string('language_universal')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('selected_languages');
    }
}
