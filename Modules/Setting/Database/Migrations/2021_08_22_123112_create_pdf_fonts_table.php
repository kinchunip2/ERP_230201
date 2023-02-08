<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePdfFontsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pdf_fonts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('font_file');
            $table->string('bold_file')->nullable();
            $table->string('italic_file')->nullable();
            $table->tinyInteger('is_active')->default(false);
            $table->timestamps();
        });


        $sql = [
            // settings
            ['id' => 662, 'module_id' => 30, 'parent_id' => 489, 'name' => 'Pdf Fonts', 'route' => 'pdf_fonts.index', 'type' => 2],
            ['id' => 663, 'module_id' => 30, 'parent_id' => 662, 'name' => 'Create', 'route' => 'pdf_fonts.store', 'type' => 3],
            ['id' => 664, 'module_id' => 30, 'parent_id' => 662, 'name' => 'Delete', 'route' => 'pdf_fonts.destroy', 'type' => 3],
            ['id' => 665, 'module_id' => 30, 'parent_id' => 662, 'name' => 'Status Change', 'route' => 'pdf_fonts.update_active_status', 'type' => 3],
        ];

        \Modules\RolePermission\Entities\Permission::insert($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pdf_fonts');
    }
}
