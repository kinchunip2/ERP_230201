<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSetupPermissionsToSettingPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Modules\RolePermission\Entities\Permission::whereIn('id', [89, 95, 106, 111])->update(['parent_id' => 66]);
        \Illuminate\Support\Facades\DB::table('role_permission')->where('permission_id', 73)->update(['permission_id' => 66]);
        \Modules\RolePermission\Entities\Permission::where('id', 73)->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
