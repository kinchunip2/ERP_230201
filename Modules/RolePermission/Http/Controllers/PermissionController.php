<?php

namespace Modules\RolePermission\Http\Controllers;

use Modules\ModuleManager\Entities\Module;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\RolePermission\Entities\Permission;
use Modules\RolePermission\Entities\Role;
use Toastr;
use Validator;
class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'permission']);
    }



    public function index(Request $request)
    {
        try{
            $role_id = $request['id'];
            if($role_id == null || $role_id == 1 ){
                return redirect(route('permission.roles.index'));
            }
            $PermissionList = Permission::all();
            $role = Role::with('permissions')->findOrFail($role_id);
            $data['role'] =  $role;
            $data['MainMenuList'] = $PermissionList->where('type',1);
            $data['SubMenuList'] = $PermissionList->where('type',2);
            $data['ActionList'] = $PermissionList->where('type',3);
            $data['PermissionList'] =  $PermissionList;
            return view('rolepermission::permission',$data);

        }catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error('Operation failed');
            return back();
        }

    }

    public function store(Request $request)
    {
        $validate_rules = [
            'role_id' => "required",
            'module_id' => "required|array"
        ];
        $validator = Validator::make($request->all(), $validate_rules, validationMessage($validate_rules) );



        if($validator->fails()){
            Toastr::error('Validation Failed', 'Failed');
            return redirect()->back();
        }

        try{
            DB::beginTransaction();
            $role  = Role::findOrFail($request->role_id);
            $default_roles = getVar('default_role');

            if (env('APP_SYNC') and in_array($role->name, $default_roles)){
                Toastr::error('Restricted in demo mode', 'Failed');
                return redirect()->back();
            }
                $role->permissions()->detach();
                $role->permissions()->attach(array_unique($request->module_id));
            DB::commit();
            \LogActivity::successLog('Permission given Successfully');
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        }catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            DB::rollback();
           Toastr::error('Operation Failed', 'Failed');
           return redirect()->back();
        }
    }
}
