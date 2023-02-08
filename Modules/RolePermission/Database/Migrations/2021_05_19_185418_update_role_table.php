<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       $system_role = \Modules\RolePermission\Entities\Role::where('id', '!=', 1)->where('type', 'system_user')->get();

       $system_role_id = $system_role->pluck('id');
        \Modules\RolePermission\Entities\Role::where('id', '!=', 1)->where('type', 'system_user')->update([
           'type' => 'regular_user'
       ]);

        $users = \App\User::whereIn('role_id', $system_role_id)->get();

        foreach ($users as $user){
           $chart_account = \Modules\Account\Entities\ChartAccount::create([
               'level' => '2',
               'is_group' => '0',
               'name' => $user->name,
               'type' => '1',
               'configuration_group_id' => 4,
               'description' => null,
               'parent_id' => 6,
               'status' => '1',
               'contactable_type' => "App\User",
               'contactable_id' => $user->id,
           ]);

           $chart_account->update([
               'code' => '01-06-'.$chart_account->id,
           ]);
        }
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
