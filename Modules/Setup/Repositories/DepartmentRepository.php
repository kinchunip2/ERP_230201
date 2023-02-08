<?php

namespace Modules\Setup\Repositories;

use Modules\Setup\Entities\Department;
use Modules\Setup\Repositories\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function all()
    {
        return Department::latest()->get();
    }

    public function create(array $data)
    {
        return Department::create($data);
    }

    public function find($id)
    {
        return Department::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        return Department::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return Department::findOrFail($id)->delete();
    }
}
