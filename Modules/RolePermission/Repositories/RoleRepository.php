<?php

namespace Modules\RolePermission\Repositories;

use Modules\RolePermission\Entities\Role;
use Modules\RolePermission\Entities\Permission;
use Auth;
use Modules\RolePermission\Repositories\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function all()
    {
        return Role::orderBy('id', 'desc')->get();
    }

    public function create(array $data)
    {
        $role = new Role();
        $role->name = $data['name'];
        $role->type = $data['type'];
        $role->save();
    }

    public function update(array $data, $id)
    {
        return Role::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        $role = Role::with('users')->findOrFail($id);
        if ($role->users->count()){
            return false;
        }
        return $role->delete();
    }

    public function normalRoles()
    {
        return Role::where('type','!=','system_user')->get();
    }

    public function regularRoles()
    {
        return Role::where('type', 'regular_user')->get();
    }

    public function findRole($id){
        return Role::findOrFail($id);
    }
}
