<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUtilitesPermissionsToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = [

            // settings
            ['id'  => 910, 'module_id' => 5, 'parent_id' => null, 'name' => 'Utilities', 'route' => 'utilities', 'type' => 1 ],
            ['id'  => 930, 'module_id' => 13, 'parent_id' => 223, 'name' => 'CNF', 'route' => 'cnf.index', 'type' => 3 ],

            ['id'  => 931, 'module_id' => 10, 'parent_id' => 170, 'name' => 'Holiday Setup', 'route' => 'leave_define.index', 'type' => 2 ],
            ['id'  => 932, 'module_id' => 10, 'parent_id' => 931, 'name' => 'Add', 'route' => 'holiday.add', 'type' => 3 ],
            ['id'  => 933, 'module_id' => 10, 'parent_id' => 931, 'name' => 'View Year Data', 'route' => 'view.year.data', 'type' => 3 ],


        ];

        DB::table('permissions')->insert($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//
    }
}
